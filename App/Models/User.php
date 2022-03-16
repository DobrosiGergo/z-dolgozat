<?php

namespace App\Models;

use App\Model;


class User extends Model
{
    protected string $table = 'user';


    public array $attributes = [
        'id' => 'int',
        'email' => 'string',
        'username' => 'string',
        'fullname' => 'string',
        'profile_img_url' => 'string',
        'category_id' => 'int',
        'instrument_id' => 'int',
        'password' => 'string',
        'recent_sheets' => 'string',
    ];

    public function getRecentSheets()
    {
        $uploadMusic = new UploadedMusic;
       if($this->recent_sheets != NULL){
        $recent_sheet_objects = json_decode($this->recent_sheets)->recent_sheets;

        $recent_sheets = [];
        foreach ($recent_sheet_objects as $recent_sheet) {

            $item = $uploadMusic->getItemById($recent_sheet->sheet_id);

            array_push($recent_sheets, [
                "title" => $item->title,
                "author_id" => $item->artist_id,
                "slug" => $item->slug,
                "date" => $recent_sheet->date,
                "time" => $recent_sheet->time
            ]);
        }

        return $recent_sheets;
       }
       else{
           return false;
       }
        
    }

    public function updateRecentSheets()
    {
    }

    public function getLikedSheets()
    {
        $db_result = parent::$DB->read_filter("liked_post", ["user_id"], $this->id);


        $musicCollection = [];

        foreach ($db_result as $item) {
            $uploadMusic = new UploadedMusic;
            $object = $uploadMusic->getItemById($item["music_id"]);
            array_push($musicCollection, $object);
        }
        return $musicCollection;
    }

    public function isLiked(int $sheet_id)
    {
        $filter = [
            "user_id" => $this->id,
            "music_id" => $sheet_id
        ];
        $db_result = parent::$DB->filter("liked_post", $filter);
        if (empty($db_result))
            return false;
        $db_result = $db_result[0]["id"];

        return $db_result;
    }

    public function like(int $sheet_id)
    {
        $data = [
            "user_id" => $this->id,
            "music_id" => $sheet_id,
            "date" => date("Y/m/d")
        ];
        try {
            parent::$DB->insert("liked_post", $data);
        } catch (\Exception $e) {
            \App\Tools::flashMessage("Valami hiba történt.");
            echo $e;
            return false;
        }
        \App\Tools::flashMessage("Mentve");
        return true;
    }

    public function unlike($like_id)
    {
        try {
            parent::$DB->delete("liked_post", $like_id);
        } catch (\Exception $e) {
            \App\Tools::FlashMessage("Valami hiba történt.");
            echo $e;
            return false;
        }
    }
}
