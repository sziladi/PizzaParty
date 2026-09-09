<?php

declare(strict_types=1);

namespace App\Core;

class Csrf
{
    private const SESSION_KEY = '_csrf_token';

    public static function token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (
            !isset($_SESSION[self::SESSION_KEY]) ||
            !is_string($_SESSION[self::SESSION_KEY])
        ) {
            $_SESSION[self::SESSION_KEY] = bin2hex(
                random_bytes(32)
            );
        }

        return $_SESSION[self::SESSION_KEY];
    }

    public static function validate(string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (
            !isset($_SESSION[self::SESSION_KEY]) ||
            !is_string($_SESSION[self::SESSION_KEY])
        ) {
            return false;
        }

        return hash_equals(
            $_SESSION[self::SESSION_KEY],
            $token
        );
    }
}