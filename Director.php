<?php

require 'Person.php';

class Director extends Person {


    /**
     * Director constructor.
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($id, $lastname, $firstname, $birthDate, $biography);
    }

    static function getAllDirectors() {
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

    static function getDirectorByIdmovie($idMovie) {
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

    function getBaseInfos() {
        require 'config/bdd.php';
        $realInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
            AND person.id = ?
            AND role = ?
        ');
        $realInfosQuery->execute(array($this->getId(), 'real'));
        $real = $realInfosQuery->fetch();
        return array(
            'id' => $this->getId(),
            'lastname' => $this->getLastname(),
            'firstname' => $this->getFirstname(),
            'birthDate' => $this->getBirthDate(),
            'biography' => $this->getBiography(),
            'role' => $real['role'],
            'path' => $real['path'],
            'legend' => $real['legend'],
            'idMovie' => $real['idMovie']
        );
    }
}