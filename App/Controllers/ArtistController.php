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
        $data['name'] = $post['author_name'];
        $data['born_age'] = $post['born_age'];
        $data['death_age'] = $post['death_age'];
        $data['description'] = $post['description'];
        $data['category_id'] =  intval($post['select']);
        $data['instrument_id'] =  intval($post['select2']);
        $data['country_name'] = $post['country_name'];
        $data['city_name'] = $post['city_name'];
        $data['slug'] = Tools::slugify($data['name'], '-');
        $data['user_id'] = $user->id;
        $img= Image::ImageUpload($_FILES,'/files/artist/');

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
