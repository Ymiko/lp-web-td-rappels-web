<?php

require 'config/config.php';

//$controller = strtolower(ucfirst(substr($_SERVER['REQUEST_URI'], 1))) . 'Controller';

$url = explode('/', substr($_SERVER['REQUEST_URI'], 1));

switch ($url[0]) {
    case 'home' :
        HomeController::index();
        break;
    case 'movie':
        MovieController::index($url[1]);
        break;
    case 'person':
        PersonController::index(array($url[1], $url[2]));
        break;
    case 'actors':
        PersonController::actors(array($url[1]));
        break;
    default:
        HomeController::index();
        break;
}