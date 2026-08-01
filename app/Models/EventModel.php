<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class EventModel
{
    public function create(
        string $eventName,
        string $restaurantName,
        string $menuUrl,
        string $eventDate
    ): void {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'INSERT INTO events (
                event_name,
                restaurant_name,
                menu_url,
                event_date
            )
            VALUES (
                :event_name,
                :restaurant_name,
                :menu_url,
                :event_date
            )'
        );

        $statement->execute([
            'event_name' => $eventName,
            'restaurant_name' => $restaurantName,
            'menu_url' => $menuUrl,
            'event_date' => $eventDate,
        ]);
    }
}