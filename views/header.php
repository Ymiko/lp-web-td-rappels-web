<header>
    <h1><a href="<?= PATH_FRONT ?>home" title="Retour à l'accueil">Filme !</a></h1>
    <?php
    	if(isset($data['menuDisplay']) && !$data['menuDisplay']) {} else {
			getBlock('views/menu', $data);
    	}
    ?>
</header>