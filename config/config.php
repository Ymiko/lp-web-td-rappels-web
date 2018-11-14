<?php
define('PATH', '/home/filme/www/');
define('PATH_FRONT', 'http://filme.alwaysdata.net/');

require PATH . 'config/functions.php';
require PATH . 'config/bdd.php';

require PATH . 'Movie.php';
require PATH . 'Person.php';
require PATH . 'Director.php';
require PATH . 'Actor.php';

require PATH . 'controller/HomeController.php';
require PATH . 'controller/MovieController.php';
require PATH . 'controller/PersonController.php';