<?php

$strIdMovie = '';
if(strpos($_SERVER['PHP_SELF'], 'index.php') === false) {
	$strIdMovie = '/' . $data['idMovie'];
}

 ?>

<a href="<?= PATH_FRONT . 'person/' . $data['id'] . $strIdMovie ?>">
	<aside>
		<figure class="figcaptionAbove">
			<figcaption><?= $data['firstname'] . ' ' . $data['lastname'] ?></figcaption>
			<img src="<?= $data['path'] ?>" alt="<?= $data['legend'] ?>">
		</figure>
	</aside>
</a>