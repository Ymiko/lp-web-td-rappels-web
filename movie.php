<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'id');

$movieQuery = $bdd->prepare('SELECT * FROM movie WHERE id = ?');
$movieQuery->execute(array($idMovie));
$movie = $movieQuery->fetch();

$pictureBannerQuery = $bdd->prepare('SELECT * FROM picture, movieHasPicture WHERE idMovie = ? AND type = ? AND movieHasPicture.idPicture = picture.id');
$pictureBannerQuery->execute(array($movie['id'], 'banner'));
$pictureBanner = $pictureBannerQuery->fetch();

$infosMovie = array($movie, $pictureBanner);

$imageInfosQuery = $bdd->prepare('
		SELECT *
		FROM picture, movieHasPicture
		WHERE picture.id = movieHasPicture.idPicture
		AND idMovie = ?
		AND type = ?
	');
$imageInfosQuery->execute(array($movie['id'], 'image'));

$actors = Actor::getActorsByIdmovie($idMovie);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $movie['title'] ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="pictures/favicon.png">
</head>
<body>
	
    <?php getBlock('header', array('idMovie' => $idMovie, 'idReal' => $realInfos['idPerson'])); ?>

    <?php getBlock('movie/bannerMovie', $infosMovie); ?>

	<main>
		
		<section>

			<article>Avec
				<?php foreach ($actors as $actor) { ?>
					<a href="#"><?= $actor->getFirstname() . ' ' . $actor->getLastname() ?></a>,
				<?php } ?>
			</article>

			<article>
				<h2>Synopsis</h2>
				<?= $movie['synopsis'] ?>
			</article>

			<section id="realANDactor">
				<h2>Réalisateur & acteurs</h2>
				<h3>Réalisateur</h3>

				<?php getBlock('movie/personInfos', Director::getDirectorByIdmovie($idMovie)->getBaseInfos()); ?>
				
				<h3>Acteurs</h3>
				
				<?php
					foreach ($actors as $actor) {
						getBlock('movie/personInfos', $actor->getBaseInfos());
					}
				?>

			</section>

			<aside id="imagesFilm">
				<h2>Images du film</h2>
				
				<?php 
					while($image = $imageInfosQuery->fetch()) {
						getBlock('movie/imageInfos', $image);
					}
				?>
				
			</aside>

		</section>
	</main>

    <?php getBlock('footer'); ?>

</body>
</html>