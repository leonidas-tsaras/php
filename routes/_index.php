<?php

$root = "/github/php/routes/";
$views = "views/";

require_once "router.php";

route('', function () {
    view("home");
});

route('about', function () {
    view("about");
});

route('contact', function () {
    view("contact");
});

function view($file = "home") {
    global $views;
    $file = $views . $file . ".php";
    include_once($views . "header.php");
    include_once($file);
    include_once($views . "footer.php");
}

function get404() {
    header("HTTP/1.0 404 Not Found");
    //return file_get_contents("404.php");
    view("404");
}

$uri = $_SERVER['REQUEST_URI'];
$uri = filter_var($uri, FILTER_SANITIZE_URL);
$uri = str_replace($root, "", $uri);
$uri = trim($uri, "/");
$uri = urldecode($uri);
dispatch($uri);