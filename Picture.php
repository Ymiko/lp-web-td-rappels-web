<?php

class Picture
{
    private $id;
    private $path;
    private $legend;

    public function __construct($id, $path, $legend)
    {
        $this->id = $id;
        $this->path = $path;
        $this->legend = $legend;
    }

    public static function createPicture($path, $legend) {
        if(!empty($path) && !empty($legend)) {
            require 'config/bdd.php';
            $queryAdd = $bdd->prepare('INSERT INTO picture(path, legend) VALUES(?,?)');
            $queryAdd->execute(array($path, $legend));
        } else {
            echo '<script>alert("Tous les champs sont obligatoires !")</script>';
        }
    }

    public static function delete($id)
    {
        require 'config/bdd.php';
        $query = $bdd->prepare('DELETE FROM picture WHERE id = ?');
        $query->execute(array($id));
    }

    public static function getAllPictures()
    {
        require 'config/bdd.php';
        $picturesQuery = $bdd->prepare('SELECT * FROM picture');
        $picturesQuery->execute();
        $allPictures = array();
        while ($picture = $picturesQuery->fetch()) {
            array_push($allPictures, new Picture($picture['id'], $picture['path'], $picture['legend']));
        }
        return $allPictures;
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @param mixed $legend
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;
    }

}