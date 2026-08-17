<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\OrganizerAuth;
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
        \App\Core\Request $request,
        Response $response
    ): void {
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