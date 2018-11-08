<?php

require 'config/config.php';

$moviesQuery = $bdd->prepare('SELECT * FROM movie ORDER BY title ASC');
$moviesQuery->execute();

$realsInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE role = ?
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
		ORDER BY lastname ASC
	');
$realsInfosQuery->execute(array('real'));

$actorsInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE role = ?
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
		ORDER BY lastname ASC
	');
$actorsInfosQuery->execute(array('actor'));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	
	<?php getBlock('header', array('menuDisplay' => false,)); ?>

	<main>
		<section id="titleFilme">
			<h1>Bienvenue sur <i>Filme !</i></h1>
		</section>

		<section>
			<h2>Les films</h2>
			<?php
				while($movie = $moviesQuery->fetch()) {
					?>
					<a href="movie.php?id=<?= $movie['id'] ?>" class="aFilm">
						<div class="film">
							<?= $movie['title'] ?>
						</div>
					</a>
					<?php
				}
			?>

			<div id="realANDactor">
				<h2>Les réalisateurs</h2>
					<?php
						$allReals = array();
						while($real = $realsInfosQuery->fetch()) {
							if(!in_array($real['id'], $allReals)) {
								array_push($allReals, $real['id']);
								getBlock('movie/personInfos', $real);
							}
						}
					?>

				<h2>Les acteurs</h2>
					<?php
						$allActors = array();
						while($actor = $actorsInfosQuery->fetch()) {
							if(!in_array($actor['id'], $allActors)) {
								array_push($allActors, $actor['id']);
								getBlock('movie/personInfos', $actor);
							}
						}
					?>
			</div>	

		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>