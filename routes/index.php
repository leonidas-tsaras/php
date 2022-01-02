<?php

$path = "/github/php/routes";

require_once "router.php";

route($path . '/', function () {
    return "Hello World";
});

route($path . '/about', function () {
    return "Hello form the about route";
});

function get404() {
    header("HTTP/1.0 404 Not Found");
    return file_get_contents("404.php");
}

$uri = $_SERVER['REQUEST_URI'];
$uri = filter_var($uri, FILTER_SANITIZE_URL);
$uri = trim($uri, "/");
$uri = urldecode($uri);
dispatch($uri);