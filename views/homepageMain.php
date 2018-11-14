<?php
    $movies = $data[0];
    $reals = $data[1];
    $actors = $data[2];
?>
<main>
    <section id="titleFilme">
        <h1>Bienvenue sur <i>Filme !</i></h1>
    </section>

    <section>
        <h2>Les films</h2>
        <?php

        foreach($movies as $movie) {
            ?>
            <a href="<?= PATH_FRONT ?>movie/<?= $movie->getId() ?>" class="aFilm">
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
            foreach ($reals as $real) {
                getBlock('views/movie/personInfos', $real->getBaseInfos());
            }
            ?>

            <h2>Les acteurs</h2>
            <?php
            foreach ($actors as $actor) {
                getBlock('views/movie/personInfos', $actor->getBaseInfos());
            }
            ?>
        </div>

    </section>
</main>