<?php

namespace App\Models;

use App\Model;



class User extends Model
{
    protected string $table = 'user';

    public array $attributes = [
        'id' => 'int',
        'email' => 'string',
        'username' => 'string',
        'fullname' => 'string',
        'profile_img_url' => 'string',
        'category_id' => 'int',
        'instrument_id' => 'int',
        'password' => 'string',
    ];
}
