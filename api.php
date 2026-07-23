<?php

    //setting header to json so the browser knows I'm handling it some data in json format
    header('Content-type: application/json');

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';
    
    libxml_use_internal_errors(true); //permet de gérer les erreurs sans crasher tout le script php


    $xml = new SimpleXMLElement($contenu);
    $html = "";
    $items = $xml->channel->item;
    $data_array = array();

    //putting the parser's data inside of an array and turning it into json
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

    $convert_to_json = json_encode($data_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

echo $convert_to_json;

