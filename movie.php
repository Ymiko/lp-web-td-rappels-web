<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'id');

$movie = Movie::getMovieById($idMovie);
$actors = Actor::getActorsByIdmovie($idMovie);
$baseInfos = $movie->getBaseInfos();
$infosMovie = array($movie, $baseInfos['banner']);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $movie->getTitle() ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="pictures/favicon.png">
</head>
<body>
	
    <?php getBlock('header', array('idMovie' => $idMovie, 'idReal' => Director::getDirectorByIdmovie($idMovie)->getId())); ?>

    <?php getBlock('movie/bannerMovie', $infosMovie); ?>

	<main>
		
		<section>

			<article>Avec
				<?php foreach ($actors as $actor) { ?>
					<a href="<?= 'person.php?id=' . $actor->getId() . '&idMovie=' . $idMovie ?>"><?= $actor->getFirstname() . ' ' . $actor->getLastname() ?></a>,
				<?php } ?>
			</article>

			<article>
				<h2>Synopsis</h2>
				<?= $movie->getSynopsis() ?>
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
                    $allImages = Movie::getImagesByIdmovie($idMovie);
					foreach ($allImages as $image) {
						getBlock('movie/imageInfos', $image);
					}
				?>
				
			</aside>

		</section>
	</main>

    <?php getBlock('footer'); ?>

</body>
</html>