<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'idMovie');

$movie = Movie::getMovieById($idMovie);
$real = Director::getDirectorByIdmovie($idMovie);
$actors = Actor::getActorsByIdmovie($idMovie);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tous les acteurs du film <?= $movie->getTitle() ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="pictures/favicon.png">
</head>
<body>
	
	<?php getBlock('header', array('idMovie' => $idMovie, 'idReal' => $real->getId())); ?>

	<main>
		
		<section>
			<h1>Tous les acteurs du film <?= $movie->getTitle() ?></h1>
		</section>
		
		<section id="realANDactor">
			<?php
				foreach ($actors as $actor) {
					getBlock('movie/personInfos', $actor->getBaseInfos());
				}
			?>
		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>