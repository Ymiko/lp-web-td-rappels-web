<?php

class Director extends Person {


    /**
     * Director constructor.
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($id, $lastname, $firstname, $birthDate, $biography);
    }

    public static function getAllDirectors() {
        require 'config/bdd.php';
        $realsInfosQuery = $bdd->prepare('
            SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, movieHasPerson.role, person.birthDate, person.biography
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE role = ?
            AND person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $realsInfosQuery->execute(array('real'));
        $allDirectors = array();
        while($real = $realsInfosQuery->fetch()) {
            array_push($allDirectors, new Director($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography']));
        }
        return $allDirectors;
    }

    public static function getDirectorByIdmovie($idMovie) {
        require 'config/bdd.php';
        $realsInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE idMovie = ?
            AND role = ?
            AND person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
        ');
        $realsInfosQuery->execute(array($idMovie, 'real'));
        $real = $realsInfosQuery->fetch();
        $Director = new Director($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography']);
        return $Director;
    }
}