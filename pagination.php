<?php

require 'loading_xml_file.php';

    //pagination
    function pagination($data_array) {
        $item_per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 6;
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        $total_news = count($data_array);
        $begin = $current_page * $item_per_page;
        $paginated_news = array_slice($data_array,$begin, $item_per_page);

        return [
            'paginated_news' => $paginated_news,
            'total_news' => $total_news,
            'current_page' => $current_page,
            'item_per_page' => $item_per_page
        ];
    };