<?php

$idMovie = $data[0];
$movie = $data[1];
$real = $data[2];
$actors = $data[3];

?>

<?php getBlock('views/head'); ?>
	
<?php getBlock('views/header', array('idMovie' => $idMovie, 'idReal' => $real->getId())); ?>

<?php getBlock('views/actorsMain', array($movie, $actors)) ?>

<?php getBlock('views/footer'); ?>
