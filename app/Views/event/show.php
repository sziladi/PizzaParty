<h2>
    🍕 <?= htmlspecialchars($event['event_name']) ?>
</h2>

<div class="event-card">

    <p>
        📍
        <strong>
            <?= htmlspecialchars($event['restaurant_name']) ?>
        </strong>
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

</div>

<div class="event-card">

    <h3>👤 Jelentkezés</h3>

    <form
        method="post"
        action="/event/<?= (int) $event['id'] ?>/participate"
    >

        <p>
            <label for="name">
                Név:
            </label>
        </p>

        <p>
            <input
                type="text"
                id="name"
                name="name"
                maxlength="100"
                required
            >
        </p>

        <button class="button" type="submit">
            🍕 Jelentkezem
        </button>

    </form>

</div>

<p>
    <a
        class="button"
        href="/event/<?= (int) $event['id'] ?>/edit"
    >
        ✏️ Szerkesztés
    </a>
</p>