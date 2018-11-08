<?php

if ($data['role'] == 'actor') { 
	$link = 'person.php?id=';
} else if($data['role'] == 'real') {
	$link = 'person.php?id=';
}

$strIdMovie = '';
if(strpos($_SERVER['PHP_SELF'], 'index.php') === false) {
	$strIdMovie = '&idMovie=' . $data['idMovie'];
}

 ?>

<a href="<?= $link . $data['idPerson'] . $strIdMovie ?>">
	<aside>
		<figure class="figcaptionAbove">
			<figcaption><?= $data['firstname'] . ' ' . $data['lastname'] ?></figcaption>
			<img src="<?= $data['path'] ?>" alt="<?= $data['legend'] ?>">
		</figure>
	</aside>
</a>