<?php

class Actor extends Person {


    /**
     * Actor constructor.
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($id, $lastname, $firstname, $birthDate, $biography);
    }

    static function getAllActors() {
        require 'config/bdd.php';
        $actorsInfosQuery = $bdd->prepare('
            SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, movieHasPerson.role, person.birthDate, person.biography
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE role = ?
            AND person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $actorsInfosQuery->execute(array('actor'));
        $allActors = array();
        while($actor = $actorsInfosQuery->fetch()) {
            array_push($allActors, new Actor($actor['idPerson'], $actor['lastname'], $actor['firstname'], $actor['birthDate'], $actor['biography']));
        }
        return $allActors;
    }

    static function getActorsByIdmovie($idMovie) {
        require 'config/bdd.php';
        $actorsInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE idMovie = ?
            AND role = ?
            AND person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $actorsInfosQuery->execute(array($idMovie, 'actor'));
        $allActors = array();
        while($actor = $actorsInfosQuery->fetch()) {
            array_push($allActors, new Actor($actor['idPerson'], $actor['lastname'], $actor['firstname'], $actor['birthDate'], $actor['biography']));
        }
        return $allActors;
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
        $realInfosQuery->execute(array($this->getId(), 'actor'));
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