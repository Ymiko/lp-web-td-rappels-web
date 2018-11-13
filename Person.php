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