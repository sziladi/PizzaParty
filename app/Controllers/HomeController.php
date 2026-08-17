<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\OrganizerAuth;
use App\Core\Response;
use App\Core\View;
use App\Models\EventModel;

class HomeController
{
    public function index(Response $response): void
    {
        $eventModel = new EventModel();

        $events = $eventModel->getAll();

        $html = View::render('home', [
            'title' => Config::get('app', 'name') . ' - Főoldal',
            'events' => $events,
            'organizerLoggedIn' => OrganizerAuth::isLoggedIn(),
        ]);

        $response->send($html);
    }
}