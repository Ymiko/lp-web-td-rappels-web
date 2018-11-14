<?php
    $movie = $data[0];
    $actors = $data[1];
?>

<main>

    <section>
        <h1>Tous les acteurs du film <?= $movie->getTitle() ?></h1>
    </section>

    <section id="realANDactor">
        <?php
        foreach ($actors as $actor) {
            getBlock('views/movie/personInfos', $actor->getBaseInfos());
        }
        ?>
    </section>
</main>