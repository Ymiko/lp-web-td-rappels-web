<?php

class MovieController {

    public static function index($request) {
        $idMovie = filter_var($request);

        $movie = Movie::getMovieById($idMovie);

        if(is_null($movie->getId())) {
            header('Location: /home');
            exit;
        }

        $actors = Actor::getActorsByIdmovie($idMovie);
        $baseInfos = $movie->getBaseInfos();
        $infosMovie = array($movie, $baseInfos['banner']);
        $real = Director::getDirectorByIdmovie($idMovie);

        getBlock('views/movie', array($idMovie, $movie, $actors, $baseInfos, $infosMovie, $real));
    }

    public static function random() {
        $tabIdMovies = Movie::getIdMovies();
        $rand = rand(1,count($tabIdMovies));
        header('Location: /movie/' . $tabIdMovies[$rand]);
        exit;
    }
}