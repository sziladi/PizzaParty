<h2>Közelgő pizzaestek</h2>

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