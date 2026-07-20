<h2>Új pizzaest</h2>

<form method="post" action="/event/create">

    <p>
        <label>Esemény neve</label><br>
        <input type="text" name="event_name">
    </p>

    <p>
        <label>Étterem neve</label><br>
        <input type="text" name="restaurant_name">
    </p>

    <p>
        <label>Étlap URL</label><br>
        <input type="url" name="menu_url">
    </p>

    <p>
        <label>Dátum</label><br>
        <input type="date" name="event_date">
    </p>

    <button type="submit">Létrehozás</button>

</form>