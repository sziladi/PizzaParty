<!DOCTYPE html>
<html lang="hu">

<head>

    <meta charset="UTF-8">

    <title><?= htmlspecialchars($title ?? 'PizzaParty') ?></title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">

</head>

<body>

<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$isHome = $path === '/';
$isCreate = $path === '/event/create';

?>

<header>

    <h1>
        <a href="/">🍕 PizzaParty</a>
    </h1>

    <p>Jelentkezés, választás – mindez egy helyen!</p>

    <?php if (!$isHome): ?>

    <nav>

        <a class="button" href="/">
            🏠 Főoldal
        </a>

    </nav>

<?php endif; ?>

</header>

<main>

<?= $content ?>

</main>

<footer>

    <hr>

    PizzaParty © 2026

</footer>

</body>

</html>