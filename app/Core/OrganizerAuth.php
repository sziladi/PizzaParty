<?php

declare(strict_types=1);

namespace App\Core;

class OrganizerAuth
{
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['organizer'])
            && $_SESSION['organizer'] === true;
    }

    public static function login(string $password): bool
    {
        $hash = getenv('ORGANIZER_PASSWORD_HASH');

        if ($hash === false || $hash === '') {
            return false;
        }

        if (!password_verify($password, $hash)) {
            return false;
        }

        $_SESSION['organizer'] = true;

        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION['organizer']);
    }

    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
}