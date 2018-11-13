<?php

require 'config/config.php';
$idMovie = filter_input(INPUT_GET, 'idMovie');
$idPerson = filter_input(INPUT_GET, 'id');

if(!empty($idMovie)) {
	$movieQuery = $bdd->prepare('SELECT * FROM movie WHERE id = ?');
	$movieQuery->execute(array($idMovie));
	$movie = $movieQuery->fetch();
}

$personInfosQuery = $bdd->prepare('
		SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE person.id =  ?
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
	');
$personInfosQuery->execute(array($idPerson));
$person = $personInfosQuery->fetch();

$moviesQuery = $bdd->prepare('
		SELECT *
		FROM movie, movieHasPerson
		WHERE idPerson = ?
		AND movie.id = movieHasPerson.idMovie
	');
$moviesQuery->execute(array($idPerson));

$real = false;
if($person['role'] == 'real') {
    $twoActorsQuery = $bdd->prepare('
        SELECT *
		FROM person, movieHasPerson, personHasPicture, picture
		WHERE role = "actor"
		AND person.id = movieHasPerson.idPerson
		AND person.id = personHasPicture.idPerson
		AND personHasPicture.idPicture = picture.id
		LIMIT 2
    ');
    $twoActorsQuery->execute();
    $real = true;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $person['firstname'] . ' ' . $person['lastname'] ?> - Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	
	<?php
		if(!empty($idMovie)) {
			getBlock('header', array('idMovie' => $idMovie, 'idReal' => $idPerson));
		} else {
			getBlock('header', array('menuDisplay' => false));
		}
	?>

	<main>
		<section>
			<h1><?= $person['firstname'] . ' ' . $person['lastname'] ?></h1>
		</section>

		<section>
			<img src="<?= $person['path'] ?>" alt="<?= $person['legend'] ?>">
			<p>Né le <time datetime="<?= date('Y-m-d', strtotime($person['birthDate'])) ?>"><?= strftime('%d %B %Y', strtotime($person['birthDate'])) ?></time></p>
			
			<aside>
				<h1>Biographie</h1>
				<?= str_replace('. ', '.<br /><br />', $person['biography']) ?>
			</aside>

			<aside>
				<h1>Filmographie</h1>
				<ul>
					<?php
						while($movie = $moviesQuery->fetch()) {
						?>
							<li><a href="movie.php?id=<?= $movie['id'] ?>"><?= $movie['title'] ?></a></li>
						<?php
						}
					?>
				</ul>
			</aside>

            <?php if($real) { ?>
            <aside id="realANDactor">
                <h1>Deux acteurs avec lesquels <?= $person['firstname'] . ' ' . $person['lastname'] ?> a le plus tourné</h1>
                <?php
                    while($actor = $twoActorsQuery->fetch()) {
                        getBlock('movie/personInfos', $actor);
                    }
                ?>
            </aside>
            <?php } ?>

		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>