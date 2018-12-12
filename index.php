<?php

require 'config/config.php';

session_start();

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
    case 'faq':
        HomeController::faq();
        break;
    case 'admin':
        AdminController::index();
        break;
    case 'logout':
        AdminController::logout();
        break;
    case 'deleteMovie':
        AdminController::deleteMovie($url[1]);
        break;
    case 'deletePicture':
        AdminController::deletePicture($url[1]);
        break;
    case 'movieRandom':
        MovieController::random();
        break;
    default:
        HomeController::index();
        break;
}