<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\OrganizerAuth;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\EventModel;
use App\Models\ParticipantModel;

class ParticipantController
{
    public function store(
        int $eventId,
        Request $request,
        Response $response
    ): void {
        $name = trim((string) $request->input('name'));

        $pizzaChoice = trim(
            (string) $request->input('pizza_choice')
        );

        // Név ellenőrzése
        if ($name === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A név megadása kötelező.</p>'
            );

            return;
        }

        // Pizzaigény ellenőrzése
        if ($pizzaChoice === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A pizza megadása kötelező.</p>'
            );

            return;
        }

        $eventModel = new EventModel();

        $event = $eventModel->findById($eventId);

        // Ellenőrizzük, hogy létezik-e a pizzaest
        if ($event === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A pizzaest nem található.</h2>'
            );

            return;
        }

        $participantModel = new ParticipantModel();

        try {

            $participant = $participantModel->create(
                $eventId,
                $name,
                $pizzaChoice
            );

        } catch (\PDOException $exception) {

            // Duplikált jelentkezés
            if (
                isset($exception->errorInfo[1]) &&
                (int) $exception->errorInfo[1] === 1062
            ) {

                http_response_code(409);

                $html = View::render(
                    'participant/duplicate',
                    [
                        'title' => 'Már jelentkeztél',
                        'event' => $event,
                        'name' => $name,
                    ]
                );

                $response->send($html);

                return;
            }

            throw $exception;
        }

        // Sikeres jelentkezés
        $html = View::render(
            'participant/success',
            [
                'title' => 'Sikeres jelentkezés',
                'event' => $event,
                'name' => $name,
                'edit_token' => $participant['edit_token'],
            ]
        );

        $response->send($html);
    }

    public function edit(
        Request $request,
        Response $response
    ): void {
        $editToken = trim(
            (string) $request->input('token')
        );

        // Módosító token ellenőrzése
        if ($editToken === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A módosító kód hiányzik.</p>'
            );

            return;
        }

        $participantModel = new ParticipantModel();

        $participant = $participantModel->findByEditToken(
            $editToken
        );

        // Érvénytelen módosító token
        if ($participant === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A módosító link érvénytelen.</h2>'
            );

            return;
        }

        // A pizzaest adatainak lekérése
        $eventModel = new EventModel();

        $event = $eventModel->findById(
            (int) $participant['event_id']
        );

        // Pizzaest nem található
        if ($event === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A pizzaest nem található.</h2>'
            );

            return;
        }

        // Módosító űrlap megjelenítése
        $html = View::render(
            'participant/edit',
            [
                'title' => 'Jelentkezés módosítása',
                'event' => $event,
                'participant' => $participant,
                'edit_token' => $editToken,
            ]
        );

        $response->send($html);
    }

    public function update(
        Request $request,
        Response $response
    ): void {
        $editToken = trim(
            (string) $request->input('token')
        );

        $name = trim(
            (string) $request->input('name')
        );

        $pizzaChoice = trim(
            (string) $request->input('pizza_choice')
        );

        // Módosító token ellenőrzése
        if ($editToken === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A módosító kód hiányzik.</p>'
            );

            return;
        }

        // Név ellenőrzése
        if ($name === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A név megadása kötelező.</p>'
            );

            return;
        }

        // Pizzaigény ellenőrzése
        if ($pizzaChoice === '') {
            http_response_code(400);

            $response->send(
                '<h2>Hiba</h2><p>A pizza megadása kötelező.</p>'
            );

            return;
        }

        $participantModel = new ParticipantModel();

        // Megkeressük a tokenhez tartozó jelentkezést
        $participant = $participantModel->findByEditToken(
            $editToken
        );

        if ($participant === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A módosító link érvénytelen.</h2>'
            );

            return;
        }

        try {

            $participantModel->updateByEditToken(
                $editToken,
                $name,
                $pizzaChoice
            );

        } catch (\PDOException $exception) {

            // A név már szerepel az adott pizzaesten
            if (
                isset($exception->errorInfo[1]) &&
                (int) $exception->errorInfo[1] === 1062
            ) {
                http_response_code(409);

                $response->send(
                    '<h2>Hiba</h2>' .
                    '<p>Ez a név már szerepel ezen a pizzaesten.</p>'
                );

                return;
            }

            throw $exception;
        }

        // Vissza az esemény oldalára
        header(
            'Location: /event/' .
            (int) $participant['event_id']
        );

        exit;
    }

    public function delete(
        int $id,
        Response $response
    ): void {
        OrganizerAuth::requireLogin();

        $participantModel = new ParticipantModel();

        $participant = $participantModel->findById($id);

        if ($participant === null) {
            http_response_code(404);

            $response->send(
                '<h2>404 - A résztvevő nem található.</h2>'
            );

            return;
        }

        $eventId = (int) $participant['event_id'];

        $participantModel->delete($id);

        header('Location: /event/' . $eventId);

        exit;
    }
}