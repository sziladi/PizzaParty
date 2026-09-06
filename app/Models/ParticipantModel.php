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
    ): array {
        $pdo = Database::connection();

        // Véletlen módosító token generálása
        $editToken = bin2hex(random_bytes(32));

        // A token hash-ét tároljuk az adatbázisban
        $editTokenHash = hash('sha256', $editToken);

        $statement = $pdo->prepare(
            'INSERT INTO participants (
                event_id,
                name,
                pizza_choice,
                edit_token_hash
            )
            VALUES (
                :event_id,
                :name,
                :pizza_choice,
                :edit_token_hash
            )'
        );

        $statement->execute([
            'event_id' => $eventId,
            'name' => $name,
            'pizza_choice' => $pizzaChoice,
            'edit_token_hash' => $editTokenHash,
        ]);

        return [
            'id' => (int) $pdo->lastInsertId(),
            'edit_token' => $editToken,
        ];
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

    public function findByEditToken(string $editToken): ?array
    {
        $pdo = Database::connection();

        $editTokenHash = hash('sha256', $editToken);

        $statement = $pdo->prepare(
            'SELECT
                id,
                event_id,
                name,
                pizza_choice,
                created_at
             FROM participants
             WHERE edit_token_hash = :edit_token_hash'
        );

        $statement->execute([
            'edit_token_hash' => $editTokenHash,
        ]);

        $participant = $statement->fetch(PDO::FETCH_ASSOC);

        return $participant ?: null;
    }

    public function updateByEditToken(
        string $editToken,
        string $name,
        string $pizzaChoice
    ): bool {
        $pdo = Database::connection();

        $editTokenHash = hash('sha256', $editToken);

        $statement = $pdo->prepare(
            'UPDATE participants
             SET
                name = :name,
                pizza_choice = :pizza_choice
             WHERE edit_token_hash = :edit_token_hash'
        );

        $statement->execute([
            'name' => $name,
            'pizza_choice' => $pizzaChoice,
            'edit_token_hash' => $editTokenHash,
        ]);

        return $statement->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $pdo = Database::connection();

        $statement = $pdo->prepare(
            'DELETE FROM participants
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->rowCount() > 0;
    }
}