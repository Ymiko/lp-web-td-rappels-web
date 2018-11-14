<?php
    $person = $data[0];
    $infosPerson = $data[1];
    $movies = $data[2];
?>

<main>
    <section>
        <h1><?= $person->getFirstname() . ' ' . $person->getLastname() ?></h1>
    </section>

    <section>
        <img src="<?= $infosPerson['path'] ?>" alt="<?= $infosPerson['legend'] ?>">
        <p>Né le <time datetime="<?= date('Y-m-d', strtotime($person->getBirthDate())) ?>"><?= strftime('%d %B %Y', strtotime($person->getBirthDate())) ?></time></p>

        <aside>
            <h1>Biographie</h1>
            <?= str_replace('. ', '.<br /><br />', $person->getBiography()) ?>
        </aside>

        <aside>
            <h1>Filmographie</h1>
            <ul>
                <?php
                foreach ($movies as $movie) {
                    ?>
                    <li><a href="<?= PATH_FRONT ?>movie/<?= $movie->getId() ?>"><?= $movie->getTitle() ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </aside>

    </section>
</main>