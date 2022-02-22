<?php

namespace App\Models;

use App\Model;

class UploadedMusic extends Model
{
    protected string $table = 'uploaded_music';

    public array $attributes = [
        'id' => 'int',
        'title' => 'string',
        'slug' => 'string',
        'embed' => 'string',
        'instrument_id' => 'int',
        'genre_id' => 'int',
        'description' => 'string',
        'artist_id' => 'int',
        'writeyear' => 'int'
    ];
}
