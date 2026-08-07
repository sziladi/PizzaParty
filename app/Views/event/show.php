<h2><?= htmlspecialchars($event['event_name']) ?></h2>

<p>
    <strong>📍 Étterem:</strong><br>
    <?= htmlspecialchars($event['restaurant_name']) ?>
</p>

<p>
    <strong>📅 Dátum:</strong><br>
    <?= htmlspecialchars($event['event_date']) ?>
</p>

<p>
    <strong>🍕 Étlap:</strong><br>

    <a
        href="<?= htmlspecialchars($event['menu_url']) ?>"
        target="_blank"
    >
        <?= htmlspecialchars($event['restaurant_name']) ?> étlapja
    </a>
</p>

<hr>

<p>

    <a class="button" href="/event/<?= $event['id'] ?>/edit">

        ✏️ Szerkesztés

    </a>

</p>