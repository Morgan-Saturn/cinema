<?php

    //setting header to json so the browser knows I'm handling it some data in json format
    header('Content-type: application/json');

    //getting the xml file inside of $contenu
    require_once 'loading_xml_file.php';
    
    //paginating the news
    $item_per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 6;
    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 0;
    $total_news = count($data_array);
    $begin = $current_page * $item_per_page;
    $paginated_news = array_slice($data_array,$begin, $item_per_page);

    $convert_to_json = json_encode(
        [ 
            "news" => $paginated_news,
            "total" => $total_news,
            "page" => $current_page,
            "perPage" => $item_per_page
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

echo $convert_to_json;