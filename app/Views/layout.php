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

use App\Core\OrganizerAuth;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$isHome = $path === '/';

$organizerLoggedIn = OrganizerAuth::isLoggedIn();

?>

<header>

    <h1>
        <a href="/">🍕 PizzaParty</a>
    </h1>

    <p>Jelentkezés, választás – mindez egy helyen!</p>

    <nav>

        <?php if (!$isHome): ?>

            <a class="button" href="/">
                🏠 Főoldal
            </a>

        <?php endif; ?>

        <?php if ($organizerLoggedIn): ?>

            <a class="button" href="/logout">
                🚪 Kijelentkezés
            </a>

        <?php else: ?>

            <a class="button" href="/login">
                🔐 Szervezői belépés
            </a>

        <?php endif; ?>

    </nav>

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