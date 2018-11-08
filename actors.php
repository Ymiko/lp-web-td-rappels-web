<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'idMovie');

$movieQuery = $bdd->prepare('SELECT * FROM movie WHERE id = ?');
$movieQuery->execute(array($idMovie));
$movie = $movieQuery->fetch();

$realInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson
		WHERE idMovie = ?
		AND role = ?
		AND person.id = movieHasPerson.idPerson
	');
$realInfosQuery->execute(array($movie['id'], 'real'));
$real = $realInfosQuery->fetch();

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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tous les acteurs du film <?= $movie['title'] ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	
	<?php getBlock('header', array('idMovie' => $idMovie, 'idReal' => $real['id'])); ?>

	<main>
		
		<section>
			<h1>Tous les acteurs du film <?= $movie['title'] ?></h1>
		</section>
		
		<section id="realANDactor">
			<?php 
				while($actor = $actorsInfosQuery->fetch()) {
					getBlock('movie/personInfos', $actor);
				}
			?>
		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>