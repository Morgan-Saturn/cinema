<?php

//var_dump($_SERVER);
$request_uri = $_SERVER['REQUEST_URI'];


if ($request_uri == '/pages/cinema/listes') {
    header("Location: /cinema/index.html");
    exit();
}
else if ($request_uri == '/pages/cinema/details') {
    header("Location: /cinema/details.html");
    exit();
}
echo($request_uri);
