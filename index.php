<?php

    $results_count = isset($_GET['new_results_count']) ? (int) $_GET['new_results_count'] : 6;
    $new_results_count = $results_count + 3;
    
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';

    $xml = new SimpleXMLElement($contenu);
    $html = "";
    $items = $xml->channel->item;
    $data_array = array();

    $max_count = count($items);
    $results_count = min($results_count, $max_count); //prend le plus petit des deux, évite notamment de faire planter si l'utilisateur rentre un grand nombre

    //for ($i = 0; $i < $results_count; $i++) {

    /*function store_json($json_titles, $json_links, $json_descriptions, $json_imgs){
        $to_json_array = [
            "titles" => $json_titles,
            "links" => $json_links,
            "descriptions" => $json_descriptions,
            "imgs" => $json_imgs
        ];
    };*/

    foreach ($items as $item){
       /* $title = (string)$items[$i]->title;
        $link = strip_tags((string)$items[$i]->link);
        $description = strip_tags((string)$items[$i]->description);
        $img_url = (string)$items[$i]->enclosure->attributes()->url;}*/
        $title = (string)($item->title ?? "No title");
        $link = strip_tags((string)$item->link ?? "#");
        $description = strip_tags((string)$item->description ?? "No description");
        $img_url = (string)$item->enclosure->attributes()->url ?? "No image found";

        $data_array[] = array(
            "title" => $title,
            "link" => $link,
            "description" => $description,
            "img" => $img_url
        );
    }

    $convert_to_json = json_encode($data_array);
    echo($convert_to_json);

        /*$html .= "
                    <div class='movie'>
                        <img class='movie_img' src='".htmlspecialchars($img_url)."' style='width: 100%; height: 100%;' alt='affiche du film'>
                        <h3 class='categories'><a href='".htmlspecialchars($link)."'>".htmlspecialchars($title)."</a></h3>
                        <p class='summary'>".htmlspecialchars($description)."</p>
                    </div>
                ";*/
        
   // }
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
    <script src="index.js"></script>
</body>
</html>
