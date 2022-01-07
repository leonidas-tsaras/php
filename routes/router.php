<?php

$routes = [];

function route($uri, Closure $callback) {
    global $routes;
    $uri = trim($uri, '/');
    $routes[$uri] = $callback;
}

function dispatch($uri) {
    global $routes;
    if(array_key_exists($uri, $routes)) {
        $callback = $routes[$uri];
        call_user_func($callback);
    } else {
        get404(); 
    }
}