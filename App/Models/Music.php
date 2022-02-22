<?php

namespace App\Models;

use App\Model;

class Music extends Model
{
    protected string $table = 'music';

    public array $attributes = [
        'id' => 'int',
        'title' => 'string',
        'alkoto_id' => 'int',
        'alkotas_adat' => 'string'
    ];
}
