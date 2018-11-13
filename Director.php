<?php

require 'Person.php';

class Director extends Person {


    /**
     * Director constructor.
     */
    public function __construct($lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($lastname, $firstname, $birthDate, $biography);
    }

    static function getAllDirectors() {
        require 'config/bdd.php';
        $realsInfosQuery = $bdd->prepare('
            SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, movieHasPerson.role
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
            array_push($allDirectors, new Director($real['lastname'], $real['firstname'], $real['birthDate'], $real['biography']));
        }
        return $allDirectors;
    }
}