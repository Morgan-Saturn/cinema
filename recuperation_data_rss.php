<?php
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
            echo "cache cache : <br/>";
            $allocine_rss = file_get_contents("cache_allo_cine.xml");
        } 

        $rss_load = simplexml_load_file($allocine_rss);
        foreach ($rss_load->channel->item as $item) {
            echo $item->title."<br>";
        }

?>