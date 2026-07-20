<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Core\Config;

class EventController
{
    public function create(): void
    {
        View::render('event/create', [
            'title' => Config::get('app', 'name') . ' - Új esemény'
        ]);
    }
}