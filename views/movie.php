<?php

$idMovie = $data[0];
$movie = $data[1];
$actors = $data[2];
$baseInfos = $data[3];
$infosMovie = $data[4];
$real = $data[5];

?>

<?php getBlock('views/head'); ?>
	
<?php getBlock('views/header', array('idMovie' => $idMovie, 'idReal' => $real->getId())); ?>

<?php getBlock('views/movie/bannerMovie', $infosMovie); ?>

<?php getBlock('views/movieMain', array($actors, $movie)) ?>

<?php getBlock('views/footer'); ?>
