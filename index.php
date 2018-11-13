<?php require 'config/config.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Filme !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Proza+Libre" rel="stylesheet">
	<meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/png" href="pictures/favicon.png">
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
                $movies = Movie::getAllMovies();
				foreach($movies as $movie) {
					?>
					<a href="movie.php?id=<?= $movie->getId() ?>" class="aFilm">
						<div class="film">
							<?= $movie->getTitle() ?>
						</div>
					</a>
					<?php
				}
			?>

			<div id="realANDactor">
				<h2>Les réalisateurs</h2>
					<?php
                        $reals = Director::getAllDirectors();
						foreach ($reals as $real) {
                            getBlock('movie/personInfos', $real->getBaseInfos());
						}
					?>

				<h2>Les acteurs</h2>
					<?php
                    $actors = Actor::getAllActors();
						foreach ($actors as $actor) {
                            getBlock('movie/personInfos', $actor->getBaseInfos());
						}
					?>
			</div>

		</section>
	</main>

	<?php getBlock('footer'); ?>

</body>
</html>