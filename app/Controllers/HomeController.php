<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Response;
use App\Core\View;
use App\Models\PizzaModel;

class HomeController
{
    public function index(Response $response): void
    {
        $pizzaModel = new PizzaModel();

        $featuredPizzas = $pizzaModel->getFeaturedPizzas();

        $html = View::render('home', [
            'title' => Config::get('app', 'name') . ' - Főoldal',
            'featuredPizzas' => $featuredPizzas
        ]);

        $response->send($html);
    }
}