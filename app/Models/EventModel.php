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
    ): int {
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

        return (int) $pdo->lastInsertId();
    }

    public function getAll(): array
    {
        $pdo = Database::connection();

        $statement = $pdo->query(
            'SELECT *
             FROM events
             ORDER BY event_date ASC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'SELECT *
             FROM events
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        $event = $statement->fetch(PDO::FETCH_ASSOC);

        return $event ?: null;
    }

    public function update(
        int $id,
        string $eventName,
        string $restaurantName,
        string $menuUrl,
        string $eventDate
    ): void {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'UPDATE events
             SET
                event_name = :event_name,
                restaurant_name = :restaurant_name,
                menu_url = :menu_url,
                event_date = :event_date
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
            'event_name' => $eventName,
            'restaurant_name' => $restaurantName,
            'menu_url' => $menuUrl,
            'event_date' => $eventDate,
        ]);
    }
}