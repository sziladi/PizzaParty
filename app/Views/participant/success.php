<div class="success-message">

    <div class="success-icon">
        ✓
    </div>

    <h2>Sikeresen jelentkeztél!</h2>

    <p>
        <strong><?= htmlspecialchars($name) ?></strong>,
        rögzítettük a jelentkezésedet.
    </p>

    <p>
        Várunk a pizzaesten! 🍕
    </p>

    <div class="event-card">

        <h3>🔐 Módosító kódod</h3>

        <p>
            Ezt a kódot mentsd el!
            Később a PizzaParty főoldalán ezzel tudod
            megnyitni és módosítani a jelentkezésedet.
        </p>

        <p>
            <code>
                <?= htmlspecialchars($edit_token) ?>
            </code>
        </p>

        <p>
            <a
                class="button"
                href="/participant/edit?token=<?= urlencode($edit_token) ?>"
            >
                ✏️ Jelentkezés módosítása
            </a>
        </p>

    </div>

    <p>
        <a
            class="button"
            href="/"
        >
            🏠 Vissza a főoldalra
        </a>
    </p>

</div>