<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class EventController
{
    public function create(Response $response): void
    {
        $html = View::render('event/create', [
            'title' => Config::get('app', 'name') . ' - Új esemény'
        ]);

        $response->send($html);
    }

    public function store(Request $request, Response $response): void
    {
        $html = '
            <h2>Pizzaest létrehozva!</h2>

            <p><strong>Esemény:</strong> '
            . htmlspecialchars((string) $request->input('event_name')) . '</p>

            <p><strong>Étterem:</strong> '
            . htmlspecialchars((string) $request->input('restaurant_name')) . '</p>

            <p><strong>Étlap:</strong> '
            . htmlspecialchars((string) $request->input('menu_url')) . '</p>

            <p><strong>Dátum:</strong> '
            . htmlspecialchars((string) $request->input('event_date')) . '</p>';

        $response->send($html);
    }
}