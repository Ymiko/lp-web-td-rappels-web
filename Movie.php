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