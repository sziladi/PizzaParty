<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Csrf;
use App\Core\OrganizerAuth;
use App\Core\Request;
use App\Core\Response;
use App\Core\Validator;
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

    public function store(
        Request $request,
        Response $response
    ): void {
        OrganizerAuth::requireLogin();

        // CSRF védelem
        $csrfToken = (string) $request->input('csrf_token');

        if (!Csrf::validate($csrfToken)) {
            http_response_code(403);

            $response->send(
                '<h2>403 - Érvénytelen kérés.</h2>' .
                '<p>A biztonsági token érvénytelen vagy hiányzik.</p>'
            );

            return;
        }

        // Bemeneti adatok
        $eventName = trim(
            (string) $request->input('event_name')
        );

        $restaurantName = trim(
            (string) $request->input('restaurant_name')
        );

        $menuUrl = trim(
            (string) $request->input('menu_url')
        );

        $eventDate = trim(
            (string) $request->input('event_date')
        );

        // Szerveroldali validáció
        $errors = Validator::validateEvent(
            $eventName,
            $restaurantName,
            $menuUrl,
            $eventDate
        );

        if (!empty($errors)) {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2>' .
                '<p>' .
                htmlspecialchars(
                    reset($errors)
                ) .
                '</p>'
            );

            return;
        }

        $eventModel = new EventModel();

        $eventId = $eventModel->create(
            $eventName,
            $restaurantName,
            $menuUrl,
            $eventDate
        );

        header('Location: /event/' . $eventId);

        exit;
    }

    public function show(
        int $id,
        Response $response
    ): void {
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

    public function edit(
        int $id,
        Response $response
    ): void {
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

        // CSRF védelem
        $csrfToken = (string) $request->input('csrf_token');

        if (!Csrf::validate($csrfToken)) {
            http_response_code(403);

            $response->send(
                '<h2>403 - Érvénytelen kérés.</h2>' .
                '<p>A biztonsági token érvénytelen vagy hiányzik.</p>'
            );

            return;
        }

        // Bemeneti adatok
        $eventName = trim(
            (string) $request->input('event_name')
        );

        $restaurantName = trim(
            (string) $request->input('restaurant_name')
        );

        $menuUrl = trim(
            (string) $request->input('menu_url')
        );

        $eventDate = trim(
            (string) $request->input('event_date')
        );

        // Szerveroldali validáció
        $errors = Validator::validateEvent(
            $eventName,
            $restaurantName,
            $menuUrl,
            $eventDate
        );

        if (!empty($errors)) {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2>' .
                '<p>' .
                htmlspecialchars(
                    reset($errors)
                ) .
                '</p>'
            );

            return;
        }

        $eventModel = new EventModel();

        $eventModel->update(
            $id,
            $eventName,
            $restaurantName,
            $menuUrl,
            $eventDate
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

    public function delete(
        int $id,
        Request $request,
        Response $response
    ): void {
        OrganizerAuth::requireLogin();

        $csrfToken = (string) $request->input('csrf_token');

        if (!Csrf::validate($csrfToken)) {
            http_response_code(403);

            $response->send(
                '<h2>403 - Érvénytelen kérés.</h2>' .
                '<p>A biztonsági token érvénytelen vagy hiányzik.</p>'
            );

            return;
        }

        $eventModel = new EventModel();

        $event = $eventModel->findById($id);

        if ($event === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A pizzaest nem található.</h2>'
            );

            return;
        }

        $eventModel->delete($id);

        header('Location: /');

        exit;
    }
}