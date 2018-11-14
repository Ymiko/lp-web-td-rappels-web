<?php

class MovieController {

    public static function index($request) {
        $idMovie = filter_var($request[0]);

        $movie = Movie::getMovieById($idMovie);
        $actors = Actor::getActorsByIdmovie($idMovie);
        $baseInfos = $movie->getBaseInfos();
        $infosMovie = array($movie, $baseInfos['banner']);
        $real = Director::getDirectorByIdmovie($idMovie);

        getBlock('views/movie', array($idMovie, $movie, $actors, $baseInfos, $infosMovie, $real));
    }
}