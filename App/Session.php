<?php

namespace App;

class Session
{
    public $session_id;
    public $user_id;
    public $expireTime;

    public function __construct(int $user_id, int $expireTime)
    {
        $this->user_id = $user_id;
    }
}
