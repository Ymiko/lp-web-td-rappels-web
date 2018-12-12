<?php getBlock('views/head'); ?>

<?php getBlock('views/header', array('menuDisplay' => false,));
$movies = $data[0];
$pictures = $data[1];
$persons = $data[2];

?>

    <main>
        <section id="titleFilme">
            <h1>Admin</i></h1>
        </section>

        <section id="sectionAdmin">

            <?php if(isAdmin()) { ?>

                <p>Bienvenue <b>admin</b> !<a href="<?= PATH_FRONT ?>logout"> Déconnexion</a></p>

                <h1>+ Les films</h1>
                <div>
                    <form method="post">
                        <input type="text" name="title" placeholder="Titre du film">
                        <input type="date" name="releaseDate" placeholder="Date de sortie">
                        <textarea name="synopsis" cols="30" rows="10" placeholder="Synopsis"></textarea>
                        <input type="number" name="rating" step="0.1" placeholder="Note sur 10" max="10" min="0">
                        <input type="submit" value="Enregistrer le film !" name="validMovie">
                    </form>

                    <hr>
                    <form method="post">
                        <select name="idMovie">
                            <?php foreach ($movies as $movie) { ?>
                                <option value="<?= $movie->getId() ?>"><?= $movie->getTitle() ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Supprimer" name="deleteMovie">
                    </form>
                </div>
                <a href=""></a>

                <h1>+ Les images</h1>
                <div>
                    <form method="post">
                        <input type="text" name="path" placeholder="Lien de l'image">
                        <input type="text" name="legend" placeholder="Légende de l'image">
                        <input type="submit" value="Enregistrer l'image !" name="validPicture">
                    </form>

                    <hr>
                    <form method="post">
                        <select name="idPicture">
                            <?php foreach ($pictures as $picture) { ?>
                                <option value="<?= $picture->getId() ?>"><?= $picture->getLegend() ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Supprimer" name="deletePicture">
                    </form>
                </div>

                <h1>+ Les personnes</h1>
                <div>
                    <form method="post">
                        <input type="text" name="lastname" placeholder="Nom">
                        <input type="text" name="firstname" placeholder="Prénom">
                        <input type="date" name="birthdate" placeholder="Date de naissance">
                        <textarea name="biography" placeholder="Biographie..." cols="30" rows="10"></textarea>
                        <input type="submit" value="Enregistrer la personne !" name="validPerson">
                    </form>

                    <hr>
                    <form method="post">
                        <select name="idPerson">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?= $person->getId() ?>"><?= $person->getFirstname() . ' ' . $person->getLastname() ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Supprimer" name="deletePerson">
                    </form>
                </div>

                <h1>+ Attacher une image à un film</h1>
                <div>
                    <form method="post">
                        <select name="idPicture">
                            <?php foreach ($pictures as $picture) { ?>
                                <option value="<?= $picture->getId() ?>"><?= $picture->getLegend() ?></option>
                            <?php } ?>
                        </select>
                        <select name="idMovie">
                            <?php foreach ($movies as $movie) { ?>
                                <option value="<?= $movie->getId() ?>"><?= $movie->getTitle() ?></option>
                            <?php } ?>
                        </select>
                        <select name="type">
                            <option value="banner">Bannière du film</option>
                            <option value="image">Image du film</option>
                            <option value="affiche">Affiche du film</option>
                        </select>
                        <input type="submit" value="Enregistrer la liaison !" name="validMovieHasPicture">
                    </form>
                </div>

                <h1>+ Attacher une image à une personne</h1>
                <div>
                    <form method="post">
                        <select name="idPicture">
                            <?php foreach ($pictures as $picture) { ?>
                                <option value="<?= $picture->getId() ?>"><?= $picture->getLegend() ?></option>
                            <?php } ?>
                        </select>
                        <select name="idPerson">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?= $person->getId() ?>"><?= $person->getFirstName() . ' ' . $person->getLastName() ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Enregistrer la liaison !" name="validPersonHasPicture">
                    </form>
                </div>

                <h1>+ Attacher une personne à un film</h1>
                <div>
                    <form method="post">
                        <select name="idPerson">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?= $person->getId() ?>"><?= $person->getFirstName() . ' ' . $person->getLastName() ?></option>
                            <?php } ?>
                        </select>
                        <select name="idMovie">
                            <?php foreach ($movies as $movie) { ?>
                                <option value="<?= $movie->getId() ?>"><?= $movie->getTitle() ?></option>
                            <?php } ?>
                        </select>
                        <select name="role">
                            <option value="real">Réalisateur</option>
                            <option value="actor">Acteur</option>
                        </select>
                        <input type="submit" value="Enregistrer la liaison !" name="validMovieHasPerson">
                    </form>
                </div>



            <?php } else { ?>
                <form method="post">
                    <input type="password" name="pass">
                    <input type="submit" name="validPass" value="Valider">
                </form>
            <?php } ?>

        </section>
    </main>

<?php getBlock('views/footer'); ?>