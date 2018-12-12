<?php

class PersonController {

    public static function index($request) {
        $idMovie = filter_var($request[1]);
        $idPerson = filter_var($request[0]);

        $real = Director::getDirectorByIdmovie($idMovie);
        $person = Person::getPersonById($idPerson);

        if(!$person) {
            header('Location: /home');
            exit;
        }

        $infosPerson = $person->getBaseInfos();
        $movies = Movie::getMoviesByIdperson($person->getId());

        getBlock('views/person', array($idMovie, $idPerson, $real, $person, $infosPerson, $movies));
    }

    public static function actors($request) {
        $idMovie = filter_var($request[0]);

        $movie = Movie::getMovieById($idMovie);
        $real = Director::getDirectorByIdmovie($idMovie);
        $actors = Actor::getActorsByIdmovie($idMovie);

        getBlock('views/actors', array($idMovie, $movie, $real, $actors));
    }
}