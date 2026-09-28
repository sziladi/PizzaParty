<div class="event-card">

    <h2>✏️ Jelentkezés módosítása</h2>

    <p>
        Itt módosíthatod a pizzaestre leadott jelentkezésedet.
    </p>

    <?php
    $errors = $errors ?? [];
    ?>

    <form
        method="post"
        action="/participant/edit"
    >

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(\App\Core\Csrf::token()) ?>"
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
                maxlength="30"
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
                maxlength="30"
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const nameInput = document.getElementById('name');
    const pizzaInput = document.getElementById('pizza_choice');

    nameInput.addEventListener('invalid', function () {
        if (nameInput.validity.valueMissing) {
            nameInput.setCustomValidity(
                'A név megadása kötelező.'
            );
        } else {
            nameInput.setCustomValidity('');
        }
    });

    nameInput.addEventListener('input', function () {
        nameInput.setCustomValidity('');
    });

    pizzaInput.addEventListener('invalid', function () {
        if (pizzaInput.validity.valueMissing) {
            pizzaInput.setCustomValidity(
                'A pizza megadása kötelező.'
            );
        } else {
            pizzaInput.setCustomValidity('');
        }
    });

    pizzaInput.addEventListener('input', function () {
        pizzaInput.setCustomValidity('');
    });

});
</script>