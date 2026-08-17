<div class="event-card">

    <h2>🔐 Szervezői belépés</h2>

    <?php if (!empty($error)): ?>

        <p>
            ❌ <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>

    <form method="post" action="/login">

        <p>
            <label for="password">
                Jelszó:
            </label>
        </p>

        <p>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </p>

        <button class="button" type="submit">
            🔐 Belépés
        </button>

    </form>

</div>