<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\OrganizerAuth;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class OrganizerController
{
    public function login(Response $response): void
    {
        if (OrganizerAuth::isLoggedIn()) {
            header('Location: /');
            exit;
        }

        $html = View::render('organizer/login', [
            'title' => 'Szervezői belépés',
        ]);

        $response->send($html);
    }

    public function authenticate(
        Request $request,
        Response $response
    ): void {
        $csrfToken = (string) $request->input('csrf_token');

        if (!Csrf::validate($csrfToken)) {
            http_response_code(403);

            $response->send(
                '<h2>403 - Érvénytelen kérés.</h2>' .
                '<p>A biztonsági token érvénytelen vagy hiányzik.</p>'
            );

            return;
        }

        $password = (string) $request->input('password');

        if (!OrganizerAuth::login($password)) {

            $html = View::render('organizer/login', [
                'title' => 'Szervezői belépés',
                'error' => 'Hibás jelszó.',
            ]);

            $response->send($html);

            return;
        }

        header('Location: /');

        exit;
    }

    public function logout(Response $response): void
    {
        OrganizerAuth::logout();

        header('Location: /');

        exit;
    }
}