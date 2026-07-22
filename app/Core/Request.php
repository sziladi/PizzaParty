<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
    public function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key]
            ?? $_GET[$key]
            ?? $default;
    }
}