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

$actorsQuery = $bdd->prepare('SELECT * FROM person, movieHasPerson WHERE role = ? AND idMovie = ? AND movieHasPerson.idPerson = person.id');
$actorsQuery->execute(array('actor', $movie['id']));

$realInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE idMovie = ?
		AND role = ?
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
	');
$realInfosQuery->execute(array($movie['id'], 'real'));
$realInfos = $realInfosQuery->fetch();

$actorsInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE idMovie = ?
		AND role = ?
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
		ORDER BY lastname ASC
	');
$actorsInfosQuery->execute(array($movie['id'], 'actor'));

$imageInfosQuery = $bdd->prepare('
		SELECT *
		FROM picture, movieHasPicture
		WHERE picture.id = movieHasPicture.idPicture
		AND idMovie = ?
		AND type = ?
	');
$imageInfosQuery->execute(array($movie['id'], 'image'));

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
				<?php while($actor = $actorsQuery->fetch()) { ?>
					<a href="#"><?= $actor['firstname'] . ' ' . $actor['lastname'] . ', ' ?></a>
				<?php } ?>
			</article>

			<article>
				<h2>Synopsis</h2>
				<?= $movie['synopsis'] ?>
			</article>

			<section id="realANDactor">
				<h2>Réalisateur & acteurs</h2>
				<h3>Réalisateur</h3>

				<?php getBlock('movie/personInfos', $realInfos); ?>
				
				<h3>Acteurs</h3>
				
				<?php 
					while($actor = $actorsInfosQuery->fetch()) {
						getBlock('movie/personInfos', $actor);
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