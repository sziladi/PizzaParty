<?php

declare(strict_types=1);

namespace App\Core;

class Validator
{
    public static function validateEvent(
        string $eventName,
        string $restaurantName,
        string $menuUrl,
        string $eventDate
    ): array {
        $errors = [];

        // Esemény neve
        if ($eventName === '') {
            $errors['event_name'] =
                'Az esemény nevének megadása kötelező.';
        } elseif (mb_strlen($eventName) > 150) {
            $errors['event_name'] =
                'Az esemény neve legfeljebb 150 karakter lehet.';
        }

        // Étterem neve
        if ($restaurantName === '') {
            $errors['restaurant_name'] =
                'Az étterem nevének megadása kötelező.';
        } elseif (mb_strlen($restaurantName) > 150) {
            $errors['restaurant_name'] =
                'Az étterem neve legfeljebb 150 karakter lehet.';
        }

        // Étlap URL
        if ($menuUrl === '') {
            $errors['menu_url'] =
                'Az étlap URL megadása kötelező.';
        } elseif (
            filter_var(
                $menuUrl,
                FILTER_VALIDATE_URL
            ) === false
        ) {
            $errors['menu_url'] =
                'Az étlap URL-je érvénytelen.';
        } elseif (mb_strlen($menuUrl) > 500) {
            $errors['menu_url'] =
                'Az étlap URL-je legfeljebb 500 karakter lehet.';
        }

        // Dátum
        if ($eventDate === '') {
            $errors['event_date'] =
                'A dátum megadása kötelező.';
        } else {
            $date = \DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $eventDate
            );

            $dateErrors = \DateTimeImmutable::getLastErrors();

            if (
                $date === false ||
                (
                    $dateErrors !== false &&
                    (
                        $dateErrors['warning_count'] > 0 ||
                        $dateErrors['error_count'] > 0
                    )
                ) ||
                $date->format('Y-m-d') !== $eventDate
            ) {
                $errors['event_date'] =
                    'A megadott dátum érvénytelen.';
            }
        }

        return $errors;
    }

    public static function validateParticipant(
        string $name,
        string $pizzaChoice
    ): array {
        $errors = [];

        // Résztvevő neve
        if ($name === '') {
            $errors['name'] =
                'A név megadása kötelező.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] =
                'A név legfeljebb 100 karakter lehet.';
        }

        // Pizza választás
        if ($pizzaChoice === '') {
            $errors['pizza_choice'] =
                'A pizza megadása kötelező.';
        } elseif (mb_strlen($pizzaChoice) > 255) {
            $errors['pizza_choice'] =
                'A pizza megnevezése legfeljebb 255 karakter lehet.';
        }

        return $errors;
    }
}