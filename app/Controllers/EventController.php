<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\OrganizerAuth;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\EventModel;
use App\Models\ParticipantModel;

class EventController
{
    public function create(Response $response): void
    {
        OrganizerAuth::requireLogin();

        $html = View::render('event/create', [
            'title' => Config::get('app', 'name') . ' - Új esemény'
        ]);

        $response->send($html);
    }

    public function store(Request $request, Response $response): void
    {
        OrganizerAuth::requireLogin();

        $eventModel = new EventModel();

        $eventId = $eventModel->create(
            (string) $request->input('event_name'),
            (string) $request->input('restaurant_name'),
            (string) $request->input('menu_url'),
            (string) $request->input('event_date')
        );

        header('Location: /event/' . $eventId);

        exit;
    }

    public function show(int $id, Response $response): void
    {
        $eventModel = new EventModel();
        $participantModel = new ParticipantModel();

        $event = $eventModel->findById($id);

        if ($event === null) {

            http_response_code(404);

            $response->send(
                '<h2>404 - Az esemény nem található.</h2>'
            );

            return;
        }

        $participants = $participantModel->getByEventId($id);

        $html = View::render('event/show', [
            'title' => $event['event_name'],
            'event' => $event,
            'participants' => $participants,
        ]);

        $response->send($html);
    }

    public function edit(int $id, Response $response): void
    {
        OrganizerAuth::requireLogin();

        $eventModel = new EventModel();

        $event = $eventModel->findById($id);

        if ($event === null) {

            http_response_code(404);

            $response->send(
                '<h2>404 - Az esemény nem található.</h2>'
            );

            return;
        }

        $html = View::render('event/edit', [
            'title' => 'Pizzaest szerkesztése',
            'event' => $event,
        ]);

        $response->send($html);
    }

    public function update(
        int $id,
        Request $request,
        Response $response
    ): void {
        OrganizerAuth::requireLogin();

        $eventModel = new EventModel();

        $eventModel->update(
            $id,
            (string) $request->input('event_name'),
            (string) $request->input('restaurant_name'),
            (string) $request->input('menu_url'),
            (string) $request->input('event_date')
        );

        $event = $eventModel->findById($id);

        $participantModel = new ParticipantModel();

        $participants = $participantModel->getByEventId($id);

        $html = View::render('event/show', [
            'title' => $event['event_name'],
            'event' => $event,
            'participants' => $participants,
        ]);

        $response->send($html);
    }
}