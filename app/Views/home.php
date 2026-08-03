<h2>🍕 PizzaParty</h2>

<p>Tervezd meg a következő pizzaestedet!</p>

<p>
    <a class="button" href="/event/create">➕ Új pizzaest létrehozása</a>
</p>

<h3>Közelgő pizzaestek</h3>

<?php if (empty($events)): ?>

    <p>Még nincs létrehozott pizzaest.</p>

<?php else: ?>

    <?php foreach ($events as $event): ?>

        <article class="event-card">

            <h4><?= htmlspecialchars($event['event_name']) ?></h4>

            <p>
                📍
                <strong><?= htmlspecialchars($event['restaurant_name']) ?></strong>
            </p>

            <p>
                📅
                <?= htmlspecialchars($event['event_date']) ?>
            </p>

            <p>
                <a
                    href="<?= htmlspecialchars($event['menu_url']) ?>"
                    target="_blank"
                >
                    🍕 <?= htmlspecialchars($event['restaurant_name']) ?> étlapja
                </a>
            </p>

        </article>

    <?php endforeach; ?>

<?php endif; ?>