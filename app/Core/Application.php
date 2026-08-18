<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\EventController;
use App\Controllers\HomeController;
use App\Controllers\ParticipantController;
use App\Controllers\OrganizerController;

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

        // Szervezői belépés
        $this->router->get('/login', [
            OrganizerController::class,
            'login',
        ]);

        $this->router->post('/login', [
            OrganizerController::class,
            'authenticate',
        ]);

        $this->router->get('/logout', [
            OrganizerController::class,
            'logout',
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

        // Jelentkezés pizzaestre
        $this->router->post('/event/{id}/participate', [
            ParticipantController::class,
            'store',
        ]);

        // Résztvevő törlése
        $this->router->post('/participant/{id}/delete', [
            ParticipantController::class,
            'delete',
        ]);

        // Pizzaest törlése
        $this->router->post('/event/{id}/delete', [
            EventController::class,
            'delete',
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