<?php

namespace App\Controllers;

use App\Session;

class SessionController
{
    public int $expireTime = 7 * 24 * 60 * 60; // 1 hét

    private Session $session;

    public function __construct()
    {
        session_start();

        $this->auth();
    }

    public function auth()
    {
        if (isset($_SESSION["user"])) {
            $this->session = $_SESSION["user"];
        }
    }

    public function create($user_id)
    {
        $time = time() + $this->expireTime;
        $_SESSION["user"] = new Session($user_id, $time);

        return true;
    }


    public function destroy()
    {
        if (isset($_SESSION["user"]))
            unset($_SESSION["user"]);

        return true;
    }

    public static function isAuth()
    {
        return isset($_SESSION["user"]);
    }

    public function getSession()
    {
        return $this->session;
    }
}
