<?php

namespace App\Models;

use App\Model;
use App\Models\Comment;
use App\Tools;

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
        $uploadedMusic = new UploadedMusic;
        if ($this->recent_sheets != NULL) {
            $recent_sheet_objects = json_decode($this->recent_sheets)->recent_sheets;

            $recent_sheets = [];
            foreach ($recent_sheet_objects as $recent_sheet) {

                $item = $uploadedMusic->getItemById($recent_sheet->sheet_id);

                array_push($recent_sheets, [
                    "title" => $item->title,
                    "author_id" => $item->artist_id,
                    "slug" => $item->slug,
                    "date" => $recent_sheet->date,
                    "time" => $recent_sheet->time
                ]);
            }

            return $recent_sheets;
        } else {
            return false;
        }
    }

    public function updateRecentSheets(UploadedMusic $uploadedMusic)
    {
        $recent_sheets = [];
        $newSheet = [
            "date" => date("Y-m-d"),
            "time" => date("H:i:s"),
            "sheet_id" => $uploadedMusic->id
        ];

        if ($this->recent_sheets != NULL) {
            $recent_sheets = json_decode($this->recent_sheets)->recent_sheets;

            $sheetExist = array_search($uploadedMusic->id, array_column($recent_sheets, 'sheet_id'));

            if ($sheetExist != false) {
                unset($recent_sheets[$sheetExist]);
                $recent_sheets = array_values($recent_sheets);
            }

            if (count($recent_sheets) == 3) {
                array_pop($recent_sheets);
            }
        }

        $recent_sheets = array_merge(array($newSheet), $recent_sheets);
        $recent_sheets = ["recent_sheets" => $recent_sheets];

        $this->set('recent_sheets', json_encode($recent_sheets));

        return $this->update();
    }

    public function clearRecentSheets()
    {
        $this->recent_sheets = null;
        return $this->update();
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
        return true;
    }
    public function InsertComment(array $post)
    {
        global $user;
        date_default_timezone_set('Europe/Budapest');
        $data['date'] = $post['date'];
        $data['comment'] = str_replace("'","",$post['comment']) ;
        $data['music_id'] = $post['music_id'];
        $data['user_id'] = $user->id;
        if(empty($data['comment'])){
            \App\Tools::FlashMessage("Az érték nem helyes.");
            return false;
        }
        else{
            try {
                parent::$DB->insert("comments", $data);
            } catch (\Exception $e) {
                \App\Tools::FlashMessage("Valami hiba történt.");
                echo $e;
                return false;
            }
        }

       
    }
    public function DeleteComment(int $id)
    {
        try {
            parent::$DB->delete("comments", $id);
            
        } catch (\Exception $e) {
            \App\Tools::FlashMessage("Valami hiba történt.");
            echo $e;
            return false;
        }
    }
}
