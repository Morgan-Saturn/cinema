<?php


    //setting header to json so the browser knows I'm handling it some data in json format
    header('Content-type: application/json');

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';
    
    //getting the function that is tasked with paginating the news 
    require 'pagination.php';

    $news = fetch_cinema_news();
    //gestion d'erreur si $news n'est pas trouvé
    if (!isset($news) || !is_array($news)) {
        exit("Data not found");
    }
    $result = paginate(
        $news,
        isset($_GET['perPage']) ? intval($_GET['perPage']) : 6, 
        isset($_GET['page']) ? intval($_GET['page']) : 0
    );

    $convert_to_json = json_encode(
        $result, 
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    );

echo $convert_to_json;
