<?php
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php

    //mise en cache du flux rss
    if(time() - filemtime("cache_allo_cine.xml") > 1800) //1800 correspond à 30 minutes converties en secondes
        {
        $allocine_rss = "https://www.allocine.fr/rss/news-cine.xml";
        //si le serveur d'allocine est inaccessible
        if (!empty($allocine_rss)) 
            {
            file_put_contents("cache_allo_cine.xml", $allocine_rss);
            }
        else    
            {
                $allocine_rss = file_get_contents("cache_allo_cine.xml");
            }
        }
        else
        {
            $allocine_rss = file_get_contents("cache_allo_cine.xml");
        } 

        $rss_load = simplexml_load_file($allocine_rss);
        foreach ($rss_load->channel->item as $item) {
            $title = htmlspecialchars($item->title ?? 'No title');
            $link = htmlspecialchars($item->link ?? '#');
            $description = htmlspecialchars($item->description ?? 'No description');
            echo "<li><a href=\"$link\">$title</a>$description</li>";
            //echo $item->link."<br>";
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
            <div class="movie_grid">
                <div class="movie_1">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film1</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
                <div class="movie_2">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film2</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
                <div class="movie_3">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film3</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
                <div class="movie_4">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film4</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
                <div class="movie_5">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film5</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
                <div class="movie_6">
                    <img class="movie_img" src="assets/example_movie.png" alt="affiche du film">
                    <h3 class="categories">Film6</h3>
                    <p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
