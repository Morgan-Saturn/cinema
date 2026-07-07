<?php
    $alocine_rss = "https://www.allocine.fr/rss/news-cine.xml";
    $rss_load = simplexml_load_file($alocine_rss);
    foreach ($rss_load->channel->item as $item) {
        echo $item->title."<br>";
    }

?>