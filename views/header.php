<header>
    <h1><a href="<?= PATH_FRONT ?>home" title="Retour à l'accueil">Filme !</a></h1>
    <?php
    	if(isset($data['menuDisplay']) && !$data['menuDisplay']) {
    	 ?>
            <nav>
                <ul>
                    <li><a href="<?= PATH_FRONT ?>faq">FAQ</a></li>
                </ul>
            </nav>
        <?php
    	} else {
			getBlock('views/menu', $data);
    	}
    ?>

</header>
<!--
<button id="hideAside">Hide Aside</button>
<button id="fadeImg">Fade Img</button>
<button id="toggleMenu">Toogle Menu</button>
-->