<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Request.php';
require_once __DIR__ . '/../app/Core/View.php';
require_once __DIR__ . '/../app/Core/Config.php';
require_once __DIR__ . '/../app/Core/Application.php';

require_once __DIR__ . '/../app/Models/PizzaModel.php';

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/EventController.php';

use App\Core\Application;

$app = new Application();

$app->run();