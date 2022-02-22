<?php

namespace App\Models;

use App\Model;

class Instruments extends Model
{
    protected string $table = 'instruments';
    public array $attributes = [
        'id' => 'int',
        'instrument_name' => 'string',
        'image' => 'string',
    ];
}
