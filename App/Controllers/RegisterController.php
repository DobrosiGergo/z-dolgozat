<?php

namespace App\Controllers;

use App\Models\User;
use App\Tools;
use App\Image;

class RegisterController
{


    public function InsertUser($post)
    {
        global $errors;

        $data['email'] = str_replace("'", "", $post['email']);
        $data['username'] = str_replace("'", "", $post['username']);
        $data['fullname'] = str_replace("'", "", $post['fullname']);
        $data['instrument_id'] = intval($post['instrument_id']);
        $data['category_id'] = intval($post['category_id']);
        $data['recent_sheets'] = '{"recent_sheets":[]}';
        $img = Image::ImageUpload($_FILES, '/files/users/');
        if (empty($data['email']) || empty($data['username']) || empty($data['fullname'])) {
            Tools::FlashMessage("Adjon meg helyes adatokat.", 'danger');
            return false;
        } else {


            if (gettype($img) == "array") array_merge($errors, $img);
            else $data['img'] = $img;
            if (empty($errors)) {
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
    }
}
