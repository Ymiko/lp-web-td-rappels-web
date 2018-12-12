<?php

class AdminController {

    public static function index() {
        if(isset($_POST['validPass'])) {
            if(getPost('pass') == '123') {
                $_SESSION['admin'] = true;
            }
        }

        if(isset($_POST['validMovie'])) {
            Movie::createMovie(getPost('title'), getPost('releaseDate'), getPost('synopsis'), getPost('rating'));
        }

        if(isset($_POST['deleteMovie'])) {
            self::deleteMovie(getPost('idMovie'));
        }

        if(isset($_POST['validPicture'])) {
            Picture::createPicture(getPost('path'), getPost('legend'));
        }

        if(isset($_POST['deletePicture'])) {
            self::deletePicture(getPost('idPicture'));
        }

        if(isset($_POST['validPerson'])) {
            Person::createPerson(getPost('lastname'), getPost('firstname'), getPost('birthdate'), getPost('biography'));
        }

        if(isset($_POST['deletePerson'])) {
            self::deletePerson(getPost('idPerson'));
        }

        if(isset($_POST['validMovieHasPicture'])) {
            Other::createMovieHasPicture(getPost('idMovie'), getPost('idPicture'), getPost('type'));
        }

        if(isset($_POST['validPersonHasPicture'])) {
            Other::createPersonHasPicture(getPost('idPerson'), getPost('idPicture'));
        }

        if(isset($_POST['validMovieHasPerson'])) {
            Other::createMovieHasPerson(getPost('idMovie'), getPost('idPerson'), getPost('role'));
        }

        $persons = Person::getAllPersons();
        $pictures = Picture::getAllPictures();
        $movies = Movie::getAllMovies();
        getBlock('views/admin/index', array($movies, $pictures, $persons));
    }

    public static function logout() {
        session_destroy();
        header('Location: /index.php');
        exit;
    }

    public static function deleteMovie($id) {
        if(isAdmin()) {
            Movie::delete($id);
            header('Location: /admin');
            exit;
        }
    }

    public static function deletePicture($id) {
        if(isAdmin()) {
            Picture::delete($id);
            header('Location: /admin');
            exit;
        }
    }

    public static function deletePerson($id) {
        if(isAdmin()) {
            Person::delete($id);
            header('Location: /admin');
            exit;
        }
    }

}