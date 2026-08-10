<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class PizzaModel
{
    public function getFeaturedPizzas(): array
    {
        $pdo = Database::connection();

        $statement = $pdo->query(
            'SELECT id, name, price
             FROM pizzas
             ORDER BY id'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}