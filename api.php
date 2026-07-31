<?php

$request_uri = $_SERVER['REQUEST_URI'];

switch($request_uri) {
    case '/pages/cinema/listes':
        header("Location: /cinema/index.html");
        exit();
    case '/pages/cinema/details':
        header("Location: /cinema/details.html");
        exit();
    case '/api/cinema/:id':
        header("Location: /cinema/api_php/details.php");
        exit();

}

if (str_starts_with($request_uri,'/api/cinema/liste')) {
    if (!str_contains($request_uri, '?')) {
        header("Location: /cinema/api_php/liste.php");
        exit();
    }
    else {
        $first_occurrence = strpos($request_uri, '?');//cette méthode me donne la position de la première occurrence du caractère voulu dans une chaîne donnée
        $uptdate = substr($request_uri, $first_occurrence);//cette méthode retourne le segment de $request_uri commençant par le caractère passé en paramètre, donc ici normalement le ? .
        header("Location: /cinema/api_php/liste".$uptdate);
        exit();
    }
}
echo($request_uri);
var_dump($_SERVER);