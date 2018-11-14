<?php
$idMovie = $data[0];
$idPerson = $data[1];
$real = $data[2];
$person = $data[3];
$infosPerson = $data[4];
$movies = $data[5];
?>

<?php getBlock('views/head'); ?>
	
<?php
    if(!empty($idMovie)) {
        getBlock('views/header', array('idMovie' => $idMovie, 'idReal' => $real->getId()));
    } else {
        getBlock('views/header', array('menuDisplay' => false));
    }
?>

<?php getBlock('views/personMain', array($person, $infosPerson, $movies)) ?>

<?php getBlock('views/footer'); ?>