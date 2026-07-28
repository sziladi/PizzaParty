<?php

declare(strict_types=1);

namespace App\Core;

class Config
{
    private static array $config = [
        'app' => [
            'name' => 'PizzaParty',
            'version' => '0.1.0',
            'environment' => 'development',
        ],

        'database' => [
            'driver'   => 'mysql',
            'host'     => 'mysql',
            'port'     => 3306,
            'database' => 'pizzaparty',
            'username' => 'pizzaparty',
            'password' => 'pizzaparty123',
            'charset'  => 'utf8mb4',
        ],
    ];

    public static function get(string $group, string $key): mixed
    {
        return self::$config[$group][$key] ?? null;
    }
}