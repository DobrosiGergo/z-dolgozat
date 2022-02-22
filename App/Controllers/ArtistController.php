<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Tools;

class ArtistController
{
    public function InsertArtist($post)
    {
        $data['name'] = $post['author_name'];
        $data['born_age'] = $post['born_age'];
        $data['death_age'] = $post['death_age'];
        $data['description'] = $post['description'];
        $data['category_id'] =  intval($post['select']);
        $data['instrument_id'] =  intval($post['select2']);
        $data['country_name'] = $post['country_name'];
        $data['city_name'] = $post['city_name'];
        $data['img'] = $post['img'];

        $data['slug'] = Tools::slugify($data['name'], '-');

        $author = new Artist($data);
        if ($author->save()) {
            Tools::FlashMessage($data['name'] . ' hozzáadva', 'success');
            header("Location: /artist");
        }
    }
}