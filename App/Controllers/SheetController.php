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

        $attributes = [
            'title' => $post['title'],
            'slug' => Tools::slugify($post['title']),
            'embed' => $post['embed'],
            'instrument_id' => intval($post['instrument']),
            'genre_id' => intval($post['genre_id']),
            'description' => $post['description'],
            'artist_id' => intval($post['artist_id']),
            'writeyear' => intval($post['writeyear']),
            'userid' => $user->id,
        ];

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
