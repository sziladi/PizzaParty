<?php

declare(strict_types=1);

namespace App\Core;

class Response
{
    public function send(string $content): void
    {
        echo $content;
    }
}