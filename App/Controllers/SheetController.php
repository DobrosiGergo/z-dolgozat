<?php

namespace App\Controllers;

use App\Models\UploadedMusic;
use App\Models\Artist;
use App\Models\User;
use App\Tools;


class SheetController
{


    public function InsertSheet($post)
    {
        global $user;

        $attributes = [
            'title' =>str_replace("'","", $post['title']),
            'slug' => Tools::slugify($post['title']),
            'embed' => str_replace("'","", $post['embed']),
            'instrument_id' => intval($post['instrument']),
            'genre_id' => intval($post['genre_id']),
            'description' => str_replace("'","", $post['description']),
            'artist_id' => intval($post['artist_id']),
            'writeyear' => intval($post['writeyear']),
            'user_id' => $user->id,
        ];
                if(empty($attributes['title']) || empty($attributes['embed']) || empty($attributes['description'])){
                    Tools::flashMessage("Nem megfelelő adat '-ne írjon", 'danger');
                  return false;
                }
                else{
                    $sheet = new UploadedMusic($attributes);

                    if ($sheet->getItemBy('title', $sheet->title)) {
            
            
                        $sheet_error = "Van már ilyen kottánk eltárolva.";
            
                        Tools::flashMessage($sheet_error, 'danger');
                        echo $sheet_error;
            
                        return false;
                    } else {
                        if ($sheet->save()) {
                            Tools::flashMessage($sheet->title . ' sikeresen elmentve!', 'success');
                            header("Location: /music");
                        }
                    }
                }
      
    }

    public static function addSheetToRecents($sheet_id, $user_id)
    {
        $user = new User();
        $user = $user->getItemById($user_id) ?? false;

        $sheet = new UploadedMusic();
        $sheet = $sheet->getItemById($sheet_id) ?? false;

        if (!$user || !$sheet)
            return false;

        return $user->updateRecentSheets($sheet);
    }
    public function UpdateSheet($post){
        global $user;
        $attributes = [
            'title' => $post['title'],
            'slug' => Tools::slugify($post['title']),
            'embed' => $post['embed'],
            'instrument_id' => intval($post['instrument_id']),
            'genre_id' => intval($post['category_id']),
            'description' => $post['description'],
            'artist_id' => intval($post['artist_id']),
            'writeyear' => intval($post['writeyear']),
            'user_id' => $user->id,
            'id'  => $post['id']
        ];
        $sheet = new UploadedMusic($attributes);
        if ($sheet->update()) {
            Tools::flashMessage($sheet->title . ' sikeresen elmentve!', 'success');
          //  header("Location: /music");
        }
    }
}
