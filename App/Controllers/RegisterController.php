<?php

namespace App\Controllers;

use App\Models\User;
use App\Tools;

class RegisterController
{


    public function InsertUser($post)
    {
        $data['email'] = $post['email'];
        $data['username'] = $post['username'];
        $data['fullname'] = $post['fullname'];
        $data['profile_img_url'] = '';
        $data['instrument'] = intval($post['instrument']);
        $data['category'] = intval($post['category']);

        if ($post['passwd'] == $post['passwd2']) {
            $data['password'] = \App\Tools::Crypt($post['passwd']);
        } else {
            $wrongmatchpassword = "Nem egyeznek a jelszavai";
            Tools::flashMessage($wrongmatchpassword, 'danger');
            echo $wrongmatchpassword;
            return false;
        }

        $userNamespace = new User;

        if ($userNamespace->getItemBy('username', $data['username'])) {
            $wrongusername = "A felhasználói név foglalt.";
            Tools::flashMessage($wrongusername, 'danger');
            echo $wrongusername;
            die();
            return false;
        }

        if ($userNamespace->getItemBy('email', $data['email'])) {
            $wrongusername = "Az e-mail cím már foglalt";
            Tools::flashMessage($wrongusername, 'danger');
            echo $wrongusername;
            die();
            return false;
        }

        $user = new User($data);

        if ($user->save()) {
            Tools::flashMessage('Sikeres regisztráció', 'success');
            header('Location: /Userhandler/login');
        }
    }
}