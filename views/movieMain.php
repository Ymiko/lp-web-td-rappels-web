<?php
    $actors = $data[0];
    $movie = $data[1];
?>
<main>

    <section>

        <article>Avec
            <?php foreach ($actors as $actor) { ?>
                <a href="<?= 'person.php?id=' . $actor->getId() . '&idMovie=' . $movie->getId() ?>"><?= $actor->getFirstname() . ' ' . $actor->getLastname() ?></a>,
            <?php } ?>
        </article>

        <article>
            <h2>Synopsis</h2>
            <?= $movie->getSynopsis() ?>
        </article>

        <section id="realANDactor">
            <h2>Réalisateur & acteurs</h2>
            <h3>Réalisateur</h3>

            <?php getBlock('views/movie/personInfos', Director::getDirectorByIdmovie($movie->getId())->getBaseInfos()); ?>

            <h3>Acteurs</h3>

            <?php
            foreach ($actors as $actor) {
                getBlock('views/movie/personInfos', $actor->getBaseInfos());
            }
            ?>

        </section>

        <aside id="imagesFilm">
            <h2>Images du film</h2>

            <?php
            $allImages = Movie::getImagesByIdmovie($movie->getId());
            foreach ($allImages as $image) {
                getBlock('views/movie/imageInfos', $image);
            }
            ?>

        </aside>

    </section>
</main>