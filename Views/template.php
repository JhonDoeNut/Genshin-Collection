<?php

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>

<body>
<header class="topbar">
    <!-- Menu -->
    <nav class="nav">
        <a class="nav__link" href="index.php">Accueil</a>
        <a class="nav__link" href="index.php?action=add-perso">Add Perso</a>
        <a class="nav__link" href="index.php?action=add-perso-attribute">Add Element</a>
        <a class="nav__link" href="index.php?action=logs">Logs</a>
        <a class="nav__link" href="index.php?action=login">Login</a>
        <a href="https://genshin.hoyoverse.com">
            <img class="game-logo" src="public/img/Genshin-Impact-Logo.png"
                 alt="Genshin Impact Logo">
        </a>
    </nav>

</header>

<!-- #contenu -->
<main id="contenu">
    <?= $this->insert('message', ['message' => $message ?? null]) ?>
    <?= $this->section('content') ?>
</main>

<footer>
    <div class="footer-inner">
        <p>Crédit de l'image de fond : <a  class="link" href="https://www.hoyolab.com/article/203736">https://www.hoyolab.com/article/203736</a>
        </p>
    </div>
</footer>
</body>
</html>
