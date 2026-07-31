<?php

$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri == '/pages/cinema/listes') {
    header("Location: /cinema/index.html");
    exit();
}
else if ($request_uri == '/pages/cinema/details') {
    header("Location: /cinema/details.html");
    exit();
}
else if (str_starts_with($request_uri,'/api/cinema/liste')) {
    if (!str_contains($request_uri, '?')) {
        header("Location: /cinema/api_php/liste.php");//trouver comment récup la fin de la chaîne. à partir de quel indice et jusqu'où, donc deux fonctions une qui donne l'indice avec le ?, vérifie sa présence ou non ==> str_contains() ?, et si oui prendre la sous chaine depuis l'index du ? jusqu'à la fin. Comment inclure ça dans le header ? je dois imbriquer des if ?
        exit();
    }
    else {
        $first_occurrence = strpos($request_uri, '?');//cette méthode me donne la position de la première occurrence du caractère voulu dans une chaîne donnée
        $uptdate = substr($request_uri, $first_occurrence);//cette méthode retourne le segment de $request_uri commençant par le caractère passé en paramètre, donc ici normalement le ? .
        header("Location: /cinema/api_php/liste".$uptdate);
        exit();
    }
}
else if ($request_uri == '/api/cinema/:id') {
    header("Location: /cinema/api_php/details.php");
    exit();
}
echo($request_uri);
var_dump($_SERVER);