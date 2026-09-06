<h2>Közelgő pizzaestek</h2>

<?php if ($organizerLoggedIn): ?>

    <p>
        <a class="button" href="/event/create">
            ➕ Új pizzaest
        </a>
    </p>

<?php endif; ?>

<div class="event-card">

    <h3>🔐 Meglévő jelentkezés módosítása</h3>

    <p>
        Ha korábban már jelentkeztél egy pizzaestre,
        a módosító kódoddal itt megnyithatod a jelentkezésedet.
    </p>

    <form
        method="get"
        action="/participant/edit"
    >

        <p>
            <label for="edit_token">
                Módosító kód:
            </label>
        </p>

        <p>
            <input
                type="text"
                id="edit_token"
                name="token"
                maxlength="64"
                required
                placeholder="Illeszd be a módosító kódodat"
            >
        </p>

        <button
            class="button"
            type="submit"
        >
            ✏️ Jelentkezés megnyitása
        </button>

    </form>

</div>

<?php if (empty($events)): ?>

    <p>Még nincs létrehozott pizzaest.</p>

<?php else: ?>

    <?php foreach ($events as $event): ?>

        <article class="event-card event-card-clickable">

            <a
                href="/event/<?= (int) $event['id'] ?>"
                class="event-card-link"
            >

                <h4>
                    <?= htmlspecialchars($event['event_name']) ?>
                </h4>

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

            </a>

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