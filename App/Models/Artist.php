<?php

namespace App\Models;

use App\Model;

class Artist extends Model
{
    protected $table = 'artist';

    protected $attributes = [
        'id' => 'int',
        'artist_name' => 'string',
        'category_id' => 'int',
        'instrument_id' => 'int',
        'city_id' => 'int',
        'country_id' => 'int',
        'szuletese' => 'string',
        'born_age' => 'int',
        'death_age' => 'int',
        'short_description' => 'int',
        'description' => 'string'
    ];
}
