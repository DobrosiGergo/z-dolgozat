<?php

namespace App\Controllers;

class LoginController
{

    public function Get_user($email, $password)
    {
        $users = new \App\Models\User;

        $users = $users->all();

        $user =  array();

        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['email'] == $email) {
                $user = $users[$i];
            }
        }

        if ($user) {
            $passwordpass = $user['password'];

            if (password_verify($password, $passwordpass)) {
                echo 'sikeres bejelentkezés';
                header('Location: /');
            } else {
                $wrongpassword = "Nem megfelelő a jelszó!";
                echo $wrongpassword;
            }
        } else {
            $wrongusername = "Nincsen ilyen felhasználó!";
            echo $wrongusername;
        }
    }
}
