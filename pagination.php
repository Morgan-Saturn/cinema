<?php

    //pagination
    function paginate(array $data, int $per_page, int $current_page) {
        
        
        $total_news = count($data);
        $item_per_page = min($per_page, $total_news);
        $total_pages = ceil($total_news/$item_per_page);
        $current_page = min($current_page, $total_pages);
        $begin = $current_page * $item_per_page;
        $paginated_news = array_slice($data,$begin, $item_per_page);

        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }

        return [
            'news' => $paginated_news,
            'total' => $total_news,
            'page' => $current_page,
            'item_per_page' => $item_per_page
        ];
    };