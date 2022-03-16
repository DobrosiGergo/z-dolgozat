<?php

use App\Helper;

require_once __DIR__ . '/../lib/autoload.php';
require_once '../views/components/sheets_item.php';
require_once '../views/components/artist_item.php';

new App\Template($user->username, 'profile');
global $user;
if (!Helper::isAuth()) header('Location: /');

$artist = new App\Models\Artist;
$categories = new App\Models\Category;
$sheetuploader = new App\Models\User;
$uploadedMusic = new App\Models\UploadedMusic;
$uploadedMusic = $uploadedMusic->getItemsBy("user_id", $user->id);
$artistByUser = $artist->getItemBy("user_id", $user->id)
?>


<div class="sheet-items my-4">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page"  href="#sheets_tab">Kották</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#artist_tab">Alkotók</a>
  </li>
</ul>
    <div class="sheets tab-content active" id="sheets_tab">
        <div class="row">
            <h3>Feltöltött kották</h3>
            <?php
            if ($uploadedMusic) {
                foreach ($uploadedMusic as $uploadedMusic) {
                    sheet_item([
                        'img_url'       => '/files/images/sheet_img.jpg',
                        'title'         => $uploadedMusic->title,
                        'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                        'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                        'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                        'page_number'   => 4,
                        'url'           => '/music/edit.php?id=' . $uploadedMusic->id,
                        'user_id'       => $user->id
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
            if ($artistByUser) {
                foreach ($artistByUser as $uploadedArtist) {
                    artist_item([
                        'img_url'       => '/files/artist/' . $artist->img,
                        'name'         => $artist->name,
                        'genre'         => $categories->getItemById($artist->id)->category,
                        'url'           => '/artist/edit.php?id=' . $artist->id,
                        'user_id'  => $user->id
                    ]);
                }
            } else {
                echo "<p>Még nem töltöttél fel semmit.</p>";
            }
            ?>
        </div>
    </div>
</div>