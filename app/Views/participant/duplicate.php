<div class="success-message">

    <div class="success-icon">
        !
    </div>

    <h2>Már jelentkeztél erre a pizzaestre</h2>

    <p>
        A(z)
        <strong><?= htmlspecialchars($name) ?></strong>
        név már szerepel ezen a pizzaesten.
    </p>

    <p>
        Ha már jelentkeztél, nincs szükség újabb jelentkezésre.
    </p>

    <p>
        <a
            class="button"
            href="/event/<?= (int) $event['id'] ?>"
        >
            🍕 Vissza a pizzaestre
        </a>
    </p>

</div>