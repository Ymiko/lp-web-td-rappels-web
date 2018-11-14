<?php

abstract class Person
{
    private $id;
    private $lastname;
    private $firstname;
    private $birthDate;
    private $biography;

    /**
     * Person constructor.
     * @param $lastname
     * @param $firstname
     * @param $birthDate
     * @param $biography
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthDate = $birthDate;
        $this->biography = $biography;
    }

    public static function getPersonById($id) {
        require 'config/bdd.php';
        $personQuery = $bdd->prepare('SELECT * FROM person, movieHasPerson WHERE id = ? AND person.id = movieHasPerson.idPerson');
        $personQuery->execute(array($id));
        $person = $personQuery->fetch();
        if($person['role'] == 'actor') {
            return new Actor($person['id'], $person['lastname'], $person['firstname'], $person['birthDate'], $person['biography']);
        } else if($person['role'] == 'real') {
            return new Director($person['id'], $person['lastname'], $person['firstname'], $person['birthDate'], $person['biography']);
        }
        return false;
    }

    public function getBaseInfos() {
        require 'config/bdd.php';
        $personInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, movieHasPerson, personHasPicture, picture
            WHERE person.id = movieHasPerson.idPerson
            AND person.id = personHasPicture.idPerson
            AND personHasPicture.idPicture = picture.id
            AND person.id = ?
        ');
        $personInfosQuery->execute(array($this->getId()));
        $person = $personInfosQuery->fetch();
        return array(
            'id' => $this->getId(),
            'lastname' => $this->getLastname(),
            'firstname' => $this->getFirstname(),
            'birthDate' => $this->getBirthDate(),
            'biography' => $this->getBiography(),
            'role' => $person['role'],
            'path' => $person['path'],
            'legend' => $person['legend'],
            'idMovie' => $person['idMovie']
        );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }



}