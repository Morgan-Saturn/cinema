<?php

require 'loading_xml_file.php';

    //pagination
    function pagination($data_array) {
        
        
        $total_news = count($data_array);
        $item_per_page = min(isset($_GET['perPage']) ? intval($_GET['perPage']) : 6, $total_news);
        $total_pages = ceil($total_news/$item_per_page);
        $current_page = min(isset($_GET['page']) ? intval($_GET['page']) : 0, $total_pages);
        $begin = $current_page * $item_per_page;
        $paginated_news = array_slice($data_array,$begin, $item_per_page);

        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }

        return [
            'paginated_news' => $paginated_news,
            'total_news' => $total_news,
            'current_page' => $current_page,
            'item_per_page' => $item_per_page
        ];
    };