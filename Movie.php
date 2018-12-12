<?php

class Movie
{
    private $id;
    private $title;
    private $releaseDate;
    private $synopsis;
    private $rating;

    public function __construct($id, $title, $releaseDate, $synopsis, $rating) {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->synopsis = $synopsis;
        $this->rating = $rating;
    }

    public static function getIdMovies() {
        require 'config/bdd.php';
        $query = $bdd->prepare('SELECT id FROM movie');
        $query->execute();
        $tabIdMovie = [];
        while($idMovie = $query->fetch()) {
            $tabIdMovie[] = $idMovie['id'];
        }
        return $tabIdMovie;
    }

    public static function delete($id) {
        require 'config/bdd.php';
        $query = $bdd->prepare('DELETE FROM movie WHERE id = ?');
        $query->execute(array($id));
    }

    public static function createMovie($title, $releaseDate, $synopsis, $rating) {
        if(!empty($title) && !empty($releaseDate) && !empty($synopsis) && !empty($rating)) {
            require 'config/bdd.php';
            $queryAdd = $bdd->prepare('INSERT INTO movie(title, releaseDate, synopsis, rating) VALUES(?,?,?,?)');
            $queryAdd->execute(array($title, $releaseDate, $synopsis, $rating));
        } else {
            echo '<script>alert("Tous les champs sont obligatoires !")</script>';
        }
    }

    public function getAffiche() {
        require 'config/bdd.php';
        $query = $bdd->prepare('SELECT path
                                FROM picture, movieHasPicture
                                WHERE movieHasPicture.idPicture = picture.id 
                                AND movieHasPicture.idMovie = ?
                                AND movieHasPicture.type = ?');
        $query->execute(array($this->getId(), 'affiche'));
        $affiche = $query->fetch()[0];
        return $affiche;
    }

    public static function getAllMovies() {
        require 'config/bdd.php';
        $moviesQuery = $bdd->prepare('SELECT * FROM movie ORDER BY title ASC');
        $moviesQuery->execute();
        $allMovies = array();
        while($movie = $moviesQuery->fetch()) {
            array_push($allMovies, new Movie($movie['id'], $movie['title'], $movie['releaseDate'], $movie['synopsis'], $movie['rating']));
        }
        return $allMovies;
    }

    public function getBaseInfos() {
        require 'config/bdd.php';
        $pictureBannerQuery = $bdd->prepare('SELECT * FROM picture, movieHasPicture WHERE idMovie = ? AND type = ? AND movieHasPicture.idPicture = picture.id');
        $pictureBannerQuery->execute(array($this->getId(), 'banner'));
        $pictureBanner = $pictureBannerQuery->fetch();

        return array(
          'title' => $this->title,
          'releaseDate' => $this->releaseDate,
          'synopsis' => $this->synopsis,
          'rating' => $this->rating,
          'banner' => $pictureBanner
        );
    }

    public static function getMovieById($id) {
        require 'config/bdd.php';
        $movieQuery = $bdd->prepare('SELECT * FROM movie WHERE id = ?');
        $movieQuery->execute(array($id));
        $movie = $movieQuery->fetch();
        return new Movie($movie['id'], $movie['title'], $movie['releaseDate'], $movie['synopsis'], $movie['rating']);
    }

    public static function getMoviesByIdperson($idPerson) {
        require 'config/bdd.php';
        $moviesQuery = $bdd->prepare('
            SELECT DISTINCT movie.id, movie.title
            FROM movie, movieHasPerson
            WHERE idPerson = ?
            AND movie.id = movieHasPerson.idMovie
        ');
        $moviesQuery->execute(array($idPerson));
        $movies = array();
        while($movie = $moviesQuery->fetch()) {
            array_push($movies, new Movie($movie['id'], $movie['title'], $movie['releaseDate'], $movie['synopsis'], $movie['rating']));
        }
        return $movies;
    }

    public static function getImagesByIdmovie($idMovie) {
        require 'config/bdd.php';
        $imageInfosQuery = $bdd->prepare('
            SELECT *
            FROM picture, movieHasPicture
            WHERE picture.id = movieHasPicture.idPicture
            AND idMovie = ?
            AND type = ?
        ');
        $imageInfosQuery->execute(array($idMovie, 'image'));
        $allImages = array();
        while($image = $imageInfosQuery->fetch()) {
            array_push($allImages, $image);
        }
        return $allImages;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @return mixed
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }
}