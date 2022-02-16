<?php

namespace App;

class Tools
{
    public static function Crypt(string $password)
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}
