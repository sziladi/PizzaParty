<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class ParticipantModel
{
    public function create(
        int $eventId,
        string $name,
        string $pizzaChoice
    ): int {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'INSERT INTO participants (
                event_id,
                name,
                pizza_choice
            )
            VALUES (
                :event_id,
                :name,
                :pizza_choice
            )'
        );

        $statement->execute([
            'event_id' => $eventId,
            'name' => $name,
            'pizza_choice' => $pizzaChoice,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function getByEventId(int $eventId): array
    {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'SELECT
                id,
                event_id,
                name,
                pizza_choice,
                created_at
             FROM participants
             WHERE event_id = :event_id
             ORDER BY name'
        );

        $statement->execute([
            'event_id' => $eventId,
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'SELECT
                id,
                event_id,
                name,
                pizza_choice,
                created_at
             FROM participants
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        $participant = $statement->fetch(PDO::FETCH_ASSOC);

        return $participant ?: null;
    }
}