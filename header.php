<header>
    <h1><a href="index.php" title="Retour à l'accueil">Filme !</a></h1>
    <?php
    	if(isset($data['menuDisplay']) && !$data['menuDisplay']) {} else {
			getBlock('menu', $data);
    	}
    ?>
</header>