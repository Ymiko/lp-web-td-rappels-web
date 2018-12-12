<?php
    $person = $data[0];
    $infosPerson = $data[1];
    $movies = $data[2];
?>

<section id="banniereActor">
    <div id="banniereInformations" class="banniereActorInfos">

        <img src="<?= $infosPerson['path'] ?>" alt="<?= $infosPerson['legend'] ?>">
        <h1><?= $person->getFirstname() . ' ' . $person->getLastname() ?></h1>
        <p>Né le <time datetime="<?= date('Y-m-d', strtotime($person->getBirthDate())) ?>"><?= strftime('%d %B %Y', strtotime($person->getBirthDate())) ?></time></p>

    </div>

</section>

<main>

    <section>
        <aside>
            <h1>Biographie</h1>
            <?= str_replace('. ', '.<br /><br />', $person->getBiography()) ?>
        </aside>

        <aside>
            <h1>Filmographie</h1>
                <?php
                foreach ($movies as $movie) {
                    ?>
                    <a href="<?= PATH_FRONT ?>movie/<?= $movie->getId() ?>"><img class="imgMovie" src="<?= $movie->getAffiche() ?>"></a>
                    <?php
                }
                ?>
        </aside>

    </section>
</main>