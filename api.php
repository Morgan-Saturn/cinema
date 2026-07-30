<?php

    //setting header to json so the browser knows I'm handling it some data in json format
    header('Content-type: application/json');

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';
    
    //getting the function that is tasked with paginating the news 
    require 'pagination.php';

    $result = pagination($data_array);

    //gestion d'erreur si $data_array n'est pas trouvé
    if (!isset($data_array) || !is_array($data_array)) {
        exit("Data not found");
    }

    $convert_to_json = json_encode(
        [ 
            "news" => $result['paginated_news'],
            "total" => $result['total_news'],
            "page" => $result['current_page'],
            "perPage" => $result['item_per_page']
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

echo $convert_to_json;