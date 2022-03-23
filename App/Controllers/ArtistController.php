<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Models\User;
use App\Tools;
use Exception;
use App\Image;
class ArtistController
{
    public function InsertArtist($post)
    {
       global $errors;
        global $user;
        $data['name'] = str_replace("'","",$post['author_name']);
        $data['born_age'] = intval($post['born_age']);
        $data['death_age'] =intval( $post['death_age']);
        $data['description'] = str_replace("'","",$post['description']);
        $data['category_id'] =  intval($post['select']);
        $data['instrument_id'] =  intval($post['select2']);
        $data['country_name'] = str_replace("'","",$post['country_name']);
        $data['city_name'] = str_replace("'","",$post['city_name']);
        $data['slug'] = Tools::slugify($data['name'], '-');
        $data['user_id'] = $user->id;
        $img= Image::ImageUpload($_FILES,'/files/artist/');
   if(empty($data['name']) || empty($data['description']) || empty($data['country_name']) || empty($data['city_name'])){
    Tools::FlashMessage("Adjon meg helyes adatokat.", 'danger');
   return false;
   }else{
    if(gettype($img) == "array") array_merge($errors,$img);
    else $data['img'] =$img;

   if(empty($errors)){
      
    $author = new Artist($data);
    try {
        if ($author->save()) {
            Tools::FlashMessage($data['name'] . ' hozzáadva', 'success');
            header("Location: /artist");
        }
    } catch (\Exception $e) {
        die();
    }
   }
   }
        

    }
    public function UpdateArtist($post){
 
    }
}
