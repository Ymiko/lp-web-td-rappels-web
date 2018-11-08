<nav>
    <ul>
        <li><a href="movie.php?id=<?= $data['idMovie'] ?>">Film</a></li>
        <li><a href="person.php?id=<?= $data['idReal'] ?>&idMovie=<?= $data['idMovie'] ?>">Réalisateur</a></li>
        <li><a href="actors.php?idMovie=<?= $data['idMovie'] ?>">Acteurs</a></li>
    </ul>
</nav>