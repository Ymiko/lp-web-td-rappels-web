<?php

$strIdMovie = '';
if(strpos($_SERVER['PHP_SELF'], 'index.php') === false) {
	$strIdMovie = '&idMovie=' . $data['idMovie'];
}

 ?>

<a href="<?= 'person.php?id=' . $data['id'] . $strIdMovie ?>">
	<aside>
		<figure class="figcaptionAbove">
			<figcaption><?= $data['firstname'] . ' ' . $data['lastname'] ?></figcaption>
			<img src="<?= $data['path'] ?>" alt="<?= $data['legend'] ?>">
		</figure>
	</aside>
</a>