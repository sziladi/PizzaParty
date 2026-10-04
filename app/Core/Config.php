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
        if ($group === 'database') {
            return match ($key) {
                'driver' => 'mysql',
                'host' => self::environment('DB_HOST', 'mysql'),
                'port' => (int) self::environment('DB_PORT', '3306'),
                'database' => self::environment(
                    'MYSQL_DATABASE',
                    'pizzaparty'
                ),
                'username' => self::environment(
                    'MYSQL_USER',
                    'pizzaparty'
                ),
                'password' => self::environment(
                    'MYSQL_PASSWORD',
                    'pizzaparty123'
                ),
                'charset' => 'utf8mb4',
                default => null,
            };
        }

        return self::$config[$group][$key] ?? null;
    }

    private static function environment(
        string $key,
        string $default
    ): string {
        $value = getenv($key);

        return $value === false || $value === ''
            ? $default
            : $value;
    }
}
