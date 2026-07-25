<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): string
    {
        extract($data);

        // Először elkészítjük a nézet tartalmát
        ob_start();

        require __DIR__ . "/../Views/{$view}.php";

        $content = ob_get_clean();

        // Most elkészítjük a teljes oldalt (layout + tartalom)
        ob_start();

        require __DIR__ . "/../Views/layout.php";

        return ob_get_clean();
    }
}