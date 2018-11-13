<?php

class Movie
{
    private $id;
    private $title;
    private $releaseDate;
    private $synopsis;
    private $rating;

    function __construct($id, $title, $releaseDate, $synopsis, $rating) {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->synopsis = $synopsis;
        $this->rating = $rating;
    }

    static function getAllMovies() {
        require 'config/bdd.php';
        $moviesQuery = $bdd->prepare('SELECT * FROM movie ORDER BY title ASC');
        $moviesQuery->execute();
        $allMovies = array();
        while($movie = $moviesQuery->fetch()) {
            array_push($allMovies, new Movie($movie['id'], $movie['title'], $movie['releaseDate'], $movie['synopsis'], $movie['rating']));
        }
        return $allMovies;
    }

    function getBaseInfos() {
        return array(
          'title' => $this->title,
          'releaseDate' => $this->releaseDate,
          'synopsis' => $this->synopsis,
          'rating' => $this->rating
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