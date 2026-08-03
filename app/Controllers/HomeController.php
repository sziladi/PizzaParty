<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Response;
use App\Core\View;
use App\Models\EventModel;
use App\Models\PizzaModel;

class HomeController
{
    public function index(Response $response): void
    {
        $pizzaModel = new PizzaModel();
        $eventModel = new EventModel();

        $featuredPizzas = $pizzaModel->getFeaturedPizzas();
        $events = $eventModel->getAll();

        $html = View::render('home', [
            'title' => Config::get('app', 'name') . ' - Főoldal',
            'featuredPizzas' => $featuredPizzas,
            'events' => $events,
        ]);

        $response->send($html);
    }
}