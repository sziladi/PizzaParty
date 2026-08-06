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
                <a class="button" href="/">Vissza a főoldalra</a>
            </p>

            <p>
                <a class="button" href="/event/create">Új pizzaest létrehozása</a>
            </p>';

        $response->send($html);
    }

    public function show(int $id, Response $response): void
    {
        $eventModel = new EventModel();

        $event = $eventModel->findById($id);

        if ($event === null) {

            http_response_code(404);

            $response->send('<h2>404 - Az esemény nem található.</h2>');

            return;
        }

        $html = View::render('event/show', [
            'title' => $event['event_name'],
            'event' => $event,
        ]);

        $response->send($html);
    }
}