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
        $fileDestination = $GLOBALS['BASE_DIR'] . $destination . $filenewname;
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


    public static function RemoveUploadedImage($imagePath)
    {
        $imagePath = $GLOBALS['BASE_DIR'] . $imagePath;
        if (unlink($imagePath)) {
            return true;
        }
        return false;
    }

    public static function UpdateImage($oldImage, $newImage, $destination)
    {
         
        $errors = [];

        if (!self::RemoveUploadedImage($destination . $oldImage)) {
            array_push($errors, 'Hiba a törléssel');
        }

        if (empty($errors))
            $newImage = self::ImageUpload($newImage, $destination);
        if ($newImage)
            return $newImage;
        else
            array_push($errors, 'Hiba a feltöltéssel');

        return $errors;
    }
}
