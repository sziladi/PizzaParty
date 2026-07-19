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
    ];

    public static function get(string $group, string $key): mixed
    {
        return self::$config[$group][$key] ?? null;
    }
}