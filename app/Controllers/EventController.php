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
    public function store(): void
{
    echo '<h2>Pizzaest létrehozva!</h2>';

    echo '<p><strong>Esemény:</strong> '
        . htmlspecialchars($_POST['event_name']) . '</p>';

    echo '<p><strong>Étterem:</strong> '
        . htmlspecialchars($_POST['restaurant_name']) . '</p>';

    echo '<p><strong>Étlap:</strong> '
        . htmlspecialchars($_POST['menu_url']) . '</p>';

    echo '<p><strong>Dátum:</strong> '
        . htmlspecialchars($_POST['event_date']) . '</p>';
}
}