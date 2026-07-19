<h2>Üdv a PizzaPartyban!</h2>

<p>Sprint #3 elkezdődött. 🚀</p>

<h3>Ajánlott pizzák</h3>

<ul>
    <?php foreach ($featuredPizzas as $pizza): ?>
        <li><?= htmlspecialchars($pizza) ?></li>
    <?php endforeach; ?>
</ul>