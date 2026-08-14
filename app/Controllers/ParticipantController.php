<?php

declare(strict_types=1);

namespace App\Controllers;

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

            $participantId = $participantModel->create(
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
            ]
        );

        $response->send($html);
    }
}