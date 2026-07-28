<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $driver = Config::get('database', 'driver');
        $host = Config::get('database', 'host');
        $port = Config::get('database', 'port');
        $database = Config::get('database', 'database');
        $username = Config::get('database', 'username');
        $password = Config::get('database', 'password');
        $charset = Config::get('database', 'charset');

        $dsn = sprintf(
            '%s:host=%s;port=%d;dbname=%s;charset=%s',
            $driver,
            $host,
            $port,
            $database,
            $charset
        );

        try {
            self::$connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $exception) {
            die('Adatbázis kapcsolódási hiba: ' . $exception->getMessage());
        }

        return self::$connection;
    }
}