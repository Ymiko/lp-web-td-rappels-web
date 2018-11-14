<?php

$movie = $data[0];
$pictureBanner = $data[1];

?>

<section id="banniereFilm" style="background: linear-gradient(to left, transparent, black),
      url('<?= $pictureBanner['path'] ?>');background-size: cover;background-position: center;">
    <div id="banniereInformations">
        <h1><?= $movie->getTitle() ?></h1>
        <time datetime="<?= date('Y', strtotime($movie->getReleaseDate())) ?>"><?= date('Y', strtotime($movie->getReleaseDate())) ?></time>

        <div class="rating rating2"><!--

                <?php for($i = 10; $i >= 1; --$i) {
                        if($i <= round($movie->getRating())) {
                            $class = 'class="ratingOrange"';
                        } else {
                            $class = '';
                        }
                ?>

                    --><a <?= $class ?> href="#<?= $i ?>" title="<?= $i ?>/10">★</a><!--
                <?php } ?>-->
        </div>

        <div id="note"><?= str_replace('.', ',', $movie->getRating()) ?></div>

    </div>

    <img src="<?= $pictureBanner['path'] ?>" alt="<?= $pictureBanner['legend'] ?>">
</section>