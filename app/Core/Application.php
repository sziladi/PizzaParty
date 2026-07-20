<?php

declare(strict_types=1);

namespace App\Core;

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
    $this->router->get(
        '/',
        [\App\Controllers\HomeController::class, 'index']
    );

    $this->router->get(
        '/event/create',
        [\App\Controllers\EventController::class, 'create']
    );
}

    public function run(): void
    {
        $this->router->dispatch(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    }
}