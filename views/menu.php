<nav>
    <ul>
        <li><a href="<?= PATH_FRONT ?>movie/<?= $data['idMovie'] ?>">Film</a></li>
        <li><a href="<?= PATH_FRONT ?>person/<?= $data['idReal'] ?>/<?= $data['idMovie'] ?>">Réalisateur</a></li>
        <li><a href="actors.php?idMovie=<?= $data['idMovie'] ?>">Acteurs</a></li>
    </ul>
</nav>