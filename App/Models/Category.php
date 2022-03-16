<?php

namespace App\Models;

use App\Model;

class Category extends Model
{
    protected string $table = 'category';

    public array $attributes = [
        'id' => 'int',
        'category' => 'string'
    ];
}
