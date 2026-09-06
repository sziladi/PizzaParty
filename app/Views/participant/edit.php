<div class="event-card">

    <h2>✏️ Jelentkezés módosítása</h2>

    <p>
        Itt módosíthatod a pizzaestre leadott jelentkezésedet.
    </p>

    <form
        method="post"
        action="/participant/edit"
    >

        <input
            type="hidden"
            name="token"
            value="<?= htmlspecialchars($edit_token) ?>"
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
                value="<?= htmlspecialchars($participant['name']) ?>"
                required
            >
        </p>

        <p>
            <label for="pizza_choice">
                Milyen pizzát szeretnél?
            </label>
        </p>

        <p>
            <textarea
                id="pizza_choice"
                name="pizza_choice"
                maxlength="255"
                rows="3"
                required
            ><?= htmlspecialchars($participant['pizza_choice']) ?></textarea>
        </p>

        <p>
            <button
                class="button"
                type="submit"
            >
                💾 Módosítás mentése
            </button>
        </p>

    </form>

</div>