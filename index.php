<?php

    $results_count = isset($_GET['new_results_count']) ? (int) $_GET['new_results_count'] : 6;
    $new_results_count = $results_count + 3;
    
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php

    $contenu = NULL;
    $allocine_rss = "https://www.allocine.fr/rss/news-cine.xml";
    $cache_allocine = "cache/cache_allocine.xml";
    
        if (!file_exists($cache_allocine) || time() - filemtime($cache_allocine) > 1800) //1800s = 30 min
        {
            try
            {
            //cURL sert à faire des appels d'API, fetch des pages web ou envoyer des données à des serveurs avec des url. Il permet de faire des requêtes http.
            $rss_curl_handle = curl_init($allocine_rss);
            curl_setopt($rss_curl_handle, CURLOPT_RETURNTRANSFER, true); //curlopt_returntransfer retourne le fichier sous forme de chaînes de caractères
            $contenu = curl_exec($rss_curl_handle) or die(curl_error($rss_curl_handle));
            }

            catch (Exception $e)
            {
                echo("Couldn't get the rss feed");
            }

            if(!empty($contenu))
            {
                file_put_contents($cache_allocine, $contenu);
            }
            else
            {
                $contenu = file_get_contents($cache_allocine);
            }
            
        }
        else
        {
            $contenu ??= file_get_contents($cache_allocine);
        }

    $xml = new SimpleXMLElement($contenu);
    $html = "";
    $items = $xml->channel->item;

    $max_count = count($items);
    $results_count = min($results_count, $max_count); //prend le plus petit des deux, évite notamment de faire planter si l'utilisateur rentre un grand nombre

    for ($i = 0; $i < $results_count; $i++) {
        $title = (string)$items[$i]->title;
        $link = strip_tags((string)$items[$i]->link);
        $description = strip_tags((string)$items[$i]->description);
        $img_url = (string)$items[$i]->enclosure->attributes()->url;

        $html .= "
                    <div class='movie'>
                        <img class='movie_img' src='".htmlspecialchars($img_url)."' style='width: 100%; height: 100%;' alt='affiche du film'>
                        <h3 class='categories'><a href='".htmlspecialchars($link)."'>".htmlspecialchars($title)."</a></h3>
                        <p class='summary'>".htmlspecialchars($description)."</p>
                    </div>
                ";
        
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet"/>
    <link rel="icon" type="image/png" sies="32x32" href="assets/cinema.png"/>

    <title>News ciné</title>
</head>
<body>
    <div class="container">
        <h1>CINEMA</h1>
        <div class="tags">
            <p class="tag_1"><span class="hashtag">#</span>Avant-premières</p>
            <p class="tag_2"><span class="hashtag">#</span>Agenda des sorties</p>
            <p class="tag_3"><span class="hashtag">#</span>Films pour enfants à l'affiche</p>
            <p class="tag_4"><span class="hashtag">#</span>Actus Ciné</p>
            <p class="tag_5"><span class="hashtag">#</span>Meilleurs films</p>
        </div>
        <div class="searchbar_container">
            <div class="searchbar">
                <input type="search" placeholder="Rechercher une salle : Nice, Bastille, 75001, UGC Lyon">
                <button type="button">RECHERCHER</button>
            </div>
                <a class="connect">Connectez-vous pour rechercher dans vos cinémas favoris</a>
        </div>
        <div class="movie_container">
            <h2>NEWS CINEMA</h2>
            <div class="movie_grid"><?php echo($html);?></div>
            <?php if($results_count < $max_count)
                    { ?>
                        <a target="_self" href="?new_results_count=<?php echo $new_results_count; ?>"><button class="voir_plus">PLUS DE NEWS</button></a>
                    <?php 
                    } ?>
        </div>
    </div>
</body>
</html>
