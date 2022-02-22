<?php

namespace App\Controllers;

use App\Tools;
use App\Models\User;

class LoginController
{

    public function Get_user($email, $password)
    {
        global $session;

        $users = new User;

        $concrateUser = $users->getItemBy('email', $email);


        if ($concrateUser) {

            $passwordpass = $concrateUser->password;

            if (password_verify($password, $passwordpass)) {


                if ($session->create($concrateUser->id)) {
                    Tools::flashMessage('<strong>Sikeres bejelentkezés</strong> Üdv ' . $concrateUser->fullname, 'success');
                    header('Location: /');
                };
            } else {
                $wrongpassword = "Nem megfelelő a jelszó!";
                Tools::flashMessage($wrongpassword, 'danger');
                echo $wrongpassword;
            }
        } else {
            $wrongusername = "Nincsen ilyen felhasználó!";
            Tools::flashMessage($wrongusername, 'danger');
            echo $wrongusername;
        }
    }
}
