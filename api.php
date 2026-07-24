<?php

    //setting header to json so the browser knows I'm handling it some data in json format
    header('Content-type: application/json');

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';
    
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php


    $xml = new SimpleXMLElement($contenu);
    $items = $xml->channel->item;
    $data_array = array();

    //putting the parser's data inside of an array and turning it into json
    foreach ($items as $item){
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

    //paginating the news
    
    $itemPerPage = 3; //use get to call it from js like you did for the current page
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 0;
    $totalNews = count($data_array);
    $begin = $currentPage * $itemPerPage;
    $paginatedNews = array_slice($data_array,$begin, $itemPerPage);

    $convert_to_json = json_encode(
        [ 
            "news" => $paginatedNews,
            "total" => $totalNews,
            "page" => $currentPage,
            "perPage" => $itemPerPage
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

echo $convert_to_json;


