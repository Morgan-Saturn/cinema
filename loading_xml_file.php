<?php 

function fetch_cinema_news(): array {
    $contenu = NULL;
    $allocine_rss = "https://www.allocine.fr/rss/news-cine.xml";
    $cache_allocine = "../cache/cache_allocine.xml";
    
        if (!file_exists($cache_allocine) || time() - filemtime($cache_allocine) > 1800) //1800s = 30 min
        {
            try
            {
            //cURL sert à faire des appels d'API, fetch des pages web ou envoyer des données à des serveurs avec des url. Il permet de faire des requêtes http.
            $rss_curl_handle = curl_init($allocine_rss);
            curl_setopt($rss_curl_handle, CURLOPT_RETURNTRANSFER, true); //curlopt_returntransfer retourne le fichier sous forme de chaînes de caractères
            $contenu = curl_exec($rss_curl_handle) or die(curl_error($rss_curl_handle));
            }

            catch (Exception $e)
            {
                echo("Couldn't get the rss feed");
            }

            if(!empty($contenu))
            {
                file_put_contents($cache_allocine, $contenu);
            }
            else
            {
                $contenu = file_get_contents($cache_allocine);
            }
            
        }
    $contenu ??= file_get_contents($cache_allocine);

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
        $id = (string)($item->guid ?? "id not found");

        $data_array[] = array(
            "title" => $title,
            "link" => $link,
            "description" => $description,
            "img" => $img_url,
            "id" => $id
        ); 
    }
    return $data_array;
}
   