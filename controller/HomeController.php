<?php

class HomeController {

    public static function index() {
        $reals = Director::getAllDirectors();
        $movies = Movie::getAllMovies();
        $actors = Actor::getAllActors();
        getBlock('views/home', array($movies, $reals, $actors));
    }
}