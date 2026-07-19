<!DOCTYPE html>
<html lang="hu">

<head>

    <meta charset="UTF-8">

    <title><?= htmlspecialchars($title ?? 'PizzaParty') ?></title>

    <link rel="stylesheet" href="/css/style.css">

</head>

<body>

<header>

    <h1>🍕 PizzaParty</h1>

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