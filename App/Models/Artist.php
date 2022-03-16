<?php

namespace App\Models;

use App\Model;

class Artist extends Model
{
    protected string $table = 'artist';

    public array $attributes = [
        'id' => 'int',
        'name' => 'string',
        'slug' => 'string',
        'user_id' => 'int',
        'born_age' => 'int',
        'death_age' => 'int',
        'description' => 'string',
        'category_id' => 'int',
        'instrument_id' => 'int',
        'country_name' => 'string',
        'city_name' => 'string',
        'img' => 'string'
    ];
}
