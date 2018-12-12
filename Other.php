<?php

class Other
{

    public static function createMovieHasPicture($idMovie, $idPicture, $type) {
        require 'config/bdd.php';
        $query = $bdd->prepare('INSERT INTO movieHasPicture(idMovie, idPicture, type) VALUES(?,?,?)');
        $query->execute(array($idMovie, $idPicture, $type));
    }

    public static function createPersonHasPicture($idPerson, $idPicture) {
        require 'config/bdd.php';
        $query = $bdd->prepare('INSERT INTO personHasPicture(idPerson, idPicture) VALUES(?,?)');
        $query->execute(array($idPerson, $idPicture));
    }

    public static function createMovieHasPerson($idMovie, $idPerson, $role) {
        require 'config/bdd.php';
        $query = $bdd->prepare('INSERT INTO movieHasPerson(idMovie, idPerson, role) VALUES(?,?,?)');
        $query->execute(array($idMovie, $idPerson, $role));
    }

}