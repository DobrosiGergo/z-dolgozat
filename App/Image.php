<?php

namespace App;

use App\Tools;

class Image
{
    public static function ImageUpload(array $file, string $destination = '/files/default_pictures/')
    {
        $errors = [];
        $filename = $file['img']['name'];
        $fileTmpName = $file['img']['tmp_name'];
        $fileSize = $file['img']['size'];
        $fileError = $file['img']['error'];
        $fileExtb = explode('.', $filename);
        $fileActExt = strtolower(end($fileExtb));
        $allow = array('jpg', 'jpeg', 'png', 'jfif');
        if (!in_array($fileActExt, $allow)) {
            Tools::FlashMessage('Nem engedélyezett kiterjesztés');
            array_push($errors, 'Nem engedélyezett kiterjesztés');
        }
        if ($fileError != 0) {
            Tools::FlashMessage('Fájl hiba');
            array_push($errors, 'Fájl hiba');
        }
        if ($fileSize > 5000000) {
            Tools::FlashMessage('Fájl meghaladja a megengedett méretet');
            array_push($errors, 'Fájl meghaladja a megengedett méretet');
        }
        $filenewname = uniqid('', true) . "." . $fileActExt;
        $fileDestination =$GLOBALS['BASE_DIR']. $destination . $filenewname;
        if (!empty($errors))  return $errors;
        try {
            if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                throw new \Exception;
            }
        } catch (\Exception $e) {
            Tools::FlashMessage('Hiba a feltöltéssel');
            array_push($errors, 'Hiba a feltöltéssel');
        }
        return $filenewname;
    }


    public static function RemoveUploadedImage()
    {

    }
    public static function UpdateImgae()
    {
        
    }
}
