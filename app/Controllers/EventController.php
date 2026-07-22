<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Request;
use App\Core\View;

class EventController
{
    public function create(): void
    {
        View::render('event/create', [
            'title' => Config::get('app', 'name') . ' - Új esemény'
        ]);
    }

    public function store(Request $request): void
    {
        echo '<h2>Pizzaest létrehozva!</h2>';

        echo '<p><strong>Esemény:</strong> '
            . htmlspecialchars((string) $request->input('event_name')) . '</p>';

        echo '<p><strong>Étterem:</strong> '
            . htmlspecialchars((string) $request->input('restaurant_name')) . '</p>';

        echo '<p><strong>Étlap:</strong> '
            . htmlspecialchars((string) $request->input('menu_url')) . '</p>';

        echo '<p><strong>Dátum:</strong> '
            . htmlspecialchars((string) $request->input('event_date')) . '</p>';
    }
}