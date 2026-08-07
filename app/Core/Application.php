<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\EventController;
use App\Controllers\HomeController;

class Application
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();

        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        // Főoldal
        $this->router->get('/', [
            HomeController::class,
            'index',
        ]);

        // Új esemény
        $this->router->get('/event/create', [
            EventController::class,
            'create',
        ]);

        $this->router->post('/event/create', [
            EventController::class,
            'store',
        ]);

        // Esemény megtekintése
        $this->router->get('/event/{id}', [
            EventController::class,
            'show',
        ]);

        // Esemény szerkesztése
        $this->router->get('/event/{id}/edit', [
            EventController::class,
            'edit',
        ]);

        $this->router->post('/event/{id}/edit', [
            EventController::class,
            'update',
        ]);
    }

    public function run(): void
    {
        $this->router->dispatch(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    }
}