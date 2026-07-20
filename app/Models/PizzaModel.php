<?php

declare(strict_types=1);

namespace App\Models;

class PizzaModel
{
    public function getFeaturedPizzas(): array
    {
        return [
            'Margherita',
            'Sonkás',
            'Hawaii',
            'Magyaros',
            'Négysajtos',
            'Guru Frutti di Mare',
            'Húshegy',
            'Bugyis pöcök szaga'
            
        ];
    }
}