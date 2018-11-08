<?php
$bdd = new PDO('mysql:host=mysql-filme.alwaysdata.net;dbname=filme_bd', 'filme', 'pass');
$bdd->exec('SET CHARACTER SET utf8');

setlocale (LC_TIME, 'fr_FR.utf8','fra');