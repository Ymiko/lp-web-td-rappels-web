<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'idMovie');
$idPerson = filter_input(INPUT_GET, 'id');

$real = Director::getDirectorByIdmovie($idMovie);
$person = Person::getPersonById($idPerson);
$infosPerson = $person->getBaseInfos();
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $person->getFirstname() . ' ' . $person->getLastname() ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="pictures/favicon.png">
</head>
<body>
	
	<?php
		if(!empty($idMovie)) {
			getBlock('header', array('idMovie' => $idMovie, 'idReal' => $real->getId()));
		} else {
			getBlock('header', array('menuDisplay' => false));
		}
	?>

	<main>
		<section>
			<h1><?= $person->getFirstname() . ' ' . $person->getLastname() ?></h1>
		</section>

		<section>
			<img src="<?= $infosPerson['path'] ?>" alt="<?= $infosPerson['legend'] ?>">
			<p>Né le <time datetime="<?= date('Y-m-d', strtotime($person->getBirthDate())) ?>"><?= strftime('%d %B %Y', strtotime($person->getBirthDate())) ?></time></p>
			
			<aside>
				<h1>Biographie</h1>
				<?= str_replace('. ', '.<br /><br />', $person->getBiography()) ?>
			</aside>

			<aside>
				<h1>Filmographie</h1>
				<ul>
					<?php
                        $movies = Movie::getMoviesByIdperson($idPerson);
						foreach ($movies as $movie) {
                    ?>
                        <li><a href="movie.php?id=<?= $movie->getId() ?>"><?= $movie->getTitle() ?></a></li>
                    <?php
                        }
					?>
				</ul>
			</aside>

		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>