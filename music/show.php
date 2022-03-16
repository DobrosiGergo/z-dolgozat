<?php

require_once __DIR__ . '/../lib/autoload.php';

use App\Models\UploadedMusic;

$uploadedMusicNamespace = new UploadedMusic;
$uploadedMusic = $uploadedMusicNamespace->getItemBy('slug', $_GET['slug']);
new App\Template($uploadedMusic->title, 'music_player');
$artist = new App\Models\Artist;
$instrument = new App\Models\Instruments;
$category = new App\Models\Category;
$SheetByUser = new App\Models\User;






if ($user) {
    $like_id = $user->isLiked($uploadedMusic->id);

    if (isset($_POST['like'])) {
        $_POST = [];
        if (!$like_id) {
            $user->like($uploadedMusic->id);
            $like_id = true;
        } else {
            $user->unlike($like_id);
            $like_id = false;
        }
    }
}


if (!$uploadedMusic) {
    echo 'Nincs ilyen feltöltött mű az adatbázisunkban...';
    return false;
}
?>
<div class="sidebar">
    <div class="toggle">
    <
    </div>
    <div class="content">
        <div class="profile">
            <div class="profile-image sheet" >
                <img src="../files/users/<?= $SheetByUser->getItemBy('id', $uploadedMusic->user_id)->img?>" alt="">
            </div>
            <div class="user">
            <?=$SheetByUser->getItemBy('id', $uploadedMusic->user_id)->username?>
            </div>
        </div>
        <div class="sheet-content">
            <h5><?=$uploadedMusic->title?></h5>
           <p><?=$artist->getItemBy('id', $uploadedMusic->artist_id)->name?></p> 
           <hr id="sidehr">
           <p><?=$uploadedMusic->description?></p>
           <br>
           <p>
               <strong>Kiadás éve: </strong><?=$uploadedMusic->writeyear?><br>
               <strong>Hangszer: </strong><?=$instrument->getItemBy('id', $uploadedMusic->instrument_id)->instrument_name?><br>
               <strong>Múfaja: </strong><?=$category->getItemBy('id', $uploadedMusic->genre_id)->category?><br>
           </p>
        </div>
        <form action="" method="post">
            <button class="btn like <?= $like_id ? 'is_liked' : '' ?>" type="submit" name="like" title="Tetszik">
                <i class="material-icons">favorite</i>
            </button>
        </form>
    </div>
</div>
    
    <div class="embed">
        <?= $uploadedMusic->embed ?>
    </div>
    <h1><?= $uploadedMusic->title ?></h1>
    <?php if ($user) : ?>
      
    <?php endif; ?>