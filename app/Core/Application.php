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

        // Szervező kijelentkezése
        $this->router->post('/logout', [
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

        // Jelentkezés módosítása
        $this->router->get('/participant/edit', [
            ParticipantController::class,
            'edit',
        ]);

        $this->router->post('/participant/edit', [
            ParticipantController::class,
            'update',
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
        try {

            // Session elindítása az alkalmazás minden kéréséhez
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            $this->router->dispatch(
                $_SERVER['REQUEST_METHOD'],
                $_SERVER['REQUEST_URI']
            );

        } catch (\Throwable $exception) {

            // A részletes technikai hiba a PHP logba kerül.
            error_log(
                sprintf(
                    'PizzaParty application error: %s in %s on line %d',
                    $exception->getMessage(),
                    $exception->getFile(),
                    $exception->getLine()
                )
            );

            // A felhasználó csak általános hibaüzenetet kap.
            http_response_code(500);

            echo View::render('error');
        }
    }
}