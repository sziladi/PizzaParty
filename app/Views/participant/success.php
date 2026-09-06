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

    <p>
        Ha később módosítani szeretnéd a jelentkezésedet,
        használd ezt a linket:
    </p>

    <p>
        <a
            class="button"
            href="/participant/edit?token=<?= urlencode($edit_token) ?>"
        >
            ✏️ Jelentkezés módosítása
        </a>
    </p>

    <p>
        <small>
            Ezt a linket érdemes elmentened, mert ezzel tudod
            később módosítani a saját jelentkezésedet.
        </small>
    </p>

    <p>
        <a
            class="button"
            href="/"
        >
            🏠 Vissza a főoldalra
        </a>
    </p>

</div>