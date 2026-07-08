<?php
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php

    $allocine_rss = "https://www.allocine.fr/rss/news-cine.xml";
    $xml = simplexml_load_file($allocine_rss) or die("can't load xml");

    $html = "";
    $items = $xml->channel->item;

    for ($i = 0; $i < 6; $i++) {
        $title = (string)$items[$i]->title;
        $link = strip_tags((string)$items[$i]->link);
        $description = strip_tags((string)$items[$i]->description);
        $img_url = (string)$items[$i]->enclosure->attributes()->url;

        $html .= "
                    <div class='movie'>
                        <img class='movie_img' src='$img_url' style='width: 100%; height: 100%;' alt='affiche du film'>
                        <h3 class='categories'><a href='$link' style='text-decoration: none; color: black;'>$title</a></h3>
                        <p class='summary'>$description</p>
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

    <title>Films à l'affiche</title>
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
            <h2>FILMS A L'AFFICHE</h2>
           <div class="movie_grid"><?php echo($html);?>
            </div>
        </div>
    </div>
</body>
</html>
