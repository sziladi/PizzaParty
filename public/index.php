<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';

use App\Core\Router;
use App\Controllers\HomeController;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);