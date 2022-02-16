<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController
{


    public function InsertUser($post)
    {
        $data['email'] = $post['email'];
        $data['username'] = $post['username'];
        $data['fullname'] = $post['fullname'];
        $data['favorite_instrument'] = intval($post['instrument']);
        $data['favorite_category'] = intval($post['category']);

        if ($post['passwd'] == $post['passwd2']){
            $data['password'] = \App\Tools::Crypt($post['passwd']);

        }
        else{
            $wrongmatchpassword ="Nem egyeznek a jelszavai";
            echo $wrongmatchpassword;
            return false;
        }

         $validate = new User();
        $users= $validate->all();
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['username'] == $data['username']) {
                $usergot = $users[$i];
            }
            if($users[$i]['email']== $data['email']){
                $useremail= $users[$i];
            }
        }

         if(!empty($usergot)){
           $wrongusername = "Van már ilyen felhasználó.";
           echo $wrongusername;
           return false;
           
         }
         else if(!empty($useremail)){
          $wrongemailmatch ="Ez az email már foglalt.";
          echo $wrongemailmatch;
          return false;
         }
         else{
            $user = new User($data);
            $user->save();
            header('Location: /login.php');
         }
    }
}
