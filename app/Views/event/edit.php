<h2>Pizzaest szerkesztése</h2>

<?php
$errors = $errors ?? [];

$eventName = $event['event_name'] ?? '';
$restaurantName = $event['restaurant_name'] ?? '';
$menuUrl = $event['menu_url'] ?? '';
$eventDate = $event['event_date'] ?? '';
?>

<form
    method="post"
    action="/event/<?= (int) $event['id'] ?>/edit"
>

    <input
        type="hidden"
        name="csrf_token"
        value="<?= htmlspecialchars(\App\Core\Csrf::token()) ?>"
    >

    <p>
        <label for="event_name">
            Esemény neve
        </label><br>

        <input
            type="text"
            id="event_name"
            name="event_name"
            value="<?= htmlspecialchars($eventName) ?>"
        >

        <?php if (isset($errors['event_name'])): ?>
            <br>
            <span class="error">
                <?= htmlspecialchars($errors['event_name']) ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="restaurant_name">
            Étterem neve
        </label><br>

        <input
            type="text"
            id="restaurant_name"
            name="restaurant_name"
            value="<?= htmlspecialchars($restaurantName) ?>"
        >

        <?php if (isset($errors['restaurant_name'])): ?>
            <br>
            <span class="error">
                <?= htmlspecialchars($errors['restaurant_name']) ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="menu_url">
            Étlap URL
        </label><br>

        <input
            type="url"
            id="menu_url"
            name="menu_url"
            value="<?= htmlspecialchars($menuUrl) ?>"
        >

        <?php if (isset($errors['menu_url'])): ?>
            <br>
            <span class="error">
                <?= htmlspecialchars($errors['menu_url']) ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="event_date">
            Dátum
        </label><br>

        <input
            type="date"
            id="event_date"
            name="event_date"
            value="<?= htmlspecialchars($eventDate) ?>"
        >

        <?php if (isset($errors['event_date'])): ?>
            <br>
            <span class="error">
                <?= htmlspecialchars($errors['event_date']) ?>
            </span>
        <?php endif; ?>
    </p>

    <button class="button" type="submit">
        💾 Mentés
    </button>

</form>