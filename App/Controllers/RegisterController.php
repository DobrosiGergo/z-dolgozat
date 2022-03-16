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

        $data['email'] = $post['email'];
        $data['username'] = $post['username'];
        $data['fullname'] = $post['fullname'];
        $data['instrument_id'] = intval($post['instrument_id']);
        $data['category_id'] = intval($post['category_id']);
        $data['recent_sheets'] = NULL;
        $img= Image::ImageUpload($_FILES,'/files/users/');

        if(gettype($img) == "array") array_merge($errors,$img);
        else $data['img']=$img;
       if(empty($errors)){
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