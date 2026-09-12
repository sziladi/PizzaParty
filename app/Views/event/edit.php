<h2>Pizzaest szerkesztése</h2>

<form method="post" action="/event/<?= (int) $event['id'] ?>/edit">

    <input
        type="hidden"
        name="csrf_token"
        value="<?= htmlspecialchars(\App\Core\Csrf::token()) ?>"
    >

    <p>
        <label>Esemény neve</label><br>

        <input
            type="text"
            name="event_name"
            value="<?= htmlspecialchars($event['event_name']) ?>"
        >
    </p>

    <p>
        <label>Étterem neve</label><br>

        <input
            type="text"
            name="restaurant_name"
            value="<?= htmlspecialchars($event['restaurant_name']) ?>"
        >
    </p>

    <p>
        <label>Étlap URL</label><br>

        <input
            type="url"
            name="menu_url"
            value="<?= htmlspecialchars($event['menu_url']) ?>"
        >
    </p>

    <p>
        <label>Dátum</label><br>

        <input
            type="date"
            name="event_date"
            value="<?= htmlspecialchars($event['event_date']) ?>"
        >
    </p>

    <button class="button" type="submit">
        💾 Mentés
    </button>

</form>