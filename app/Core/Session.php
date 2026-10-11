<?php

declare(strict_types=1);

namespace App\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        $secure = getenv('SESSION_SECURE');

        session_set_cookie_params([
            'httponly' => true,
            'secure' => $secure === 'true',
            'samesite' => 'Lax',
        ]);

        session_start();
    }
}
