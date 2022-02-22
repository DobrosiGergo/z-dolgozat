<?php

namespace App;

use App\Models\User;

class Helper
{

    public static function isAuth()
    {
        $status = Controllers\SessionController::isAuth();
        return  $status;
    }

    public static function user()
    {
        global $session;
        global $user;

        if (self::isAuth()) {
            $user_id = $session->getSession()->user_id;

            $userNamespace = new User();

            $user = $userNamespace->getItemById($user_id);

            return $user;
        } else {
            return false;
        }
    }
}
