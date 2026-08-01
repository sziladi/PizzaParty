<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\EventModel;

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
        $eventModel = new EventModel();

        $eventModel->create(
            (string) $request->input('event_name'),
            (string) $request->input('restaurant_name'),
            (string) $request->input('menu_url'),
            (string) $request->input('event_date')
        );

        $html = '
            <h2>Pizzaest sikeresen létrehozva!</h2>

            <p>Az esemény bekerült az adatbázisba.</p>

            <p>
                <a href="/">Vissza a főoldalra</a>
            </p>

            <p>
                <a href="/event/create">Új esemény létrehozása</a>
            </p>';

        $response->send($html);
    }
}