<?php

namespace App\Models;

use App\Model;

class Comment extends Model
{
    protected string $table = 'comments';

    public array $attributes = [
        'id' => 'int',
        'user_id' => 'int',
        'music_id' => 'int',
        'date' => 'string',
        'comment' => 'string'
    ];
}
