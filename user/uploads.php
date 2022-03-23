<?php

use App\Helper;

require_once __DIR__ . '/../lib/autoload.php';
require_once '../views/components/sheets_item.php';
require_once '../views/components/artist_item.php';
global $user;
$artist = new App\Models\Artist;
new App\Template($user->username, 'profile');
if (!Helper::isAuth()) header('Location: /');
$categories = new App\Models\Category;
$UploadedMusicCollection = new App\Models\UploadedMusic;
$UploadedMusicCollection = $UploadedMusicCollection->getItemsBy("user_id", $user->id);
$UploadedArtist = $artist->getItemsBy("user_id",$user->id);
?>


<div class="sheet-items my-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" data-tab="sheets_tab">Kották</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-tab="artist_tab">Alkotók</a>
        </li>
    </ul>
    <div class="sheets tab-content active" id="sheets_tab">
        <div class="row">
            <h3>Feltöltött kották</h3>
            <?php
            if ($UploadedMusicCollection) {
                foreach ($UploadedMusicCollection as $uploadedMusic) {
                    $ownsByTheUserBool =  $uploadedMusic->ownsByTheUser($user->id);
                    sheet_item([
                        'img_url'       => '/files/images/sheet_img.jpg',
                        'title'         => $uploadedMusic->title,
                        'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                        'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                        'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                        'page_number'   => 4,
                        'url'           => '/music/' . $uploadedMusic->slug,
                        'auth' =>  $ownsByTheUserBool
                    ]);
                }
            } else {
                echo "<p>Még nem töltöttél fel semmit.</p>";
            }
            ?>
        </div>
    </div>
    <div class="artist tab-content" id="artist_tab">
        <div class="row">
            <h3>Feltöltött Alkotók</h3>
            <?php

            if ($UploadedArtist) {
                foreach ($UploadedArtist as $artistuser) {
                    $ownsByTheUserBool = $artistuser->ownsByTheUser($user->id);
                    artist_item([
                       'name' => $artistuser->name,
                       'img_url' => '/files/artist/'.$artistuser->img,
                       'url' => '/artist/'.$artistuser->slug,
                        'auth' =>  $ownsByTheUserBool
                    ]);
                }
            } else {
                echo "<p>Még nem töltöttél fel semmit.</p>";
            }
            ?>
        </div>
    </div>
</div>