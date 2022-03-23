<?php

require_once __DIR__ . '/../lib/autoload.php';

use App\Models\UploadedMusic;

$uploadedMusicNamespace = new UploadedMusic;
$uploadedMusic = $uploadedMusicNamespace->getItemBy('slug', $_GET['slug']);
$commentNamespace = new App\Models\Comment;
new App\Template($uploadedMusic->title, 'music_player');
$artist = new App\Models\Artist;
$instrument = new App\Models\Instruments;
$category = new App\Models\Category;
$SheetByUser = new App\Models\User;
$comments = $commentNamespace->getItemsBy('music_id', $uploadedMusic->id);


if ($user) {
    $isLiked = $user->isLiked($uploadedMusic->id);

    if (isset($_POST['submit_comment'])) {
        $user->InsertComment($_POST);
        $comments = $commentNamespace->getItemsBy('music_id', $uploadedMusic->id);
    }
    if (isset($_POST['delete_comment'])) {
        $user->DeleteComment($_POST['comment_id']);
        $comments = $commentNamespace->getItemsBy('music_id', $uploadedMusic->id);
    }
}


if (!$uploadedMusic) {
    echo 'Nincs ilyen feltöltött mű az adatbázisunkban...';
    return false;
}
?>
<div class="sidebar isOpened">
    <div class="toggle">
        <i class="material-icons">chevron_left</i>
    </div>
    <div class="content">
        <div class="profile">
            <div class="profile-image sheet">
                <img src="../files/users/<?= $SheetByUser->getItemBy('id', $uploadedMusic->user_id)->img ?>" alt="">
            </div>
            <div class="user">
                <?= $SheetByUser->getItemBy('id', $uploadedMusic->user_id)->username ?>
            </div>
        </div>
        <div class="sheet-content">
            <h5><?= $uploadedMusic->title ?></h5>
            <h6><?= $artist->getItemBy('id', $uploadedMusic->artist_id)->name ?></h6>
            <div class="controllers">
                <button class="btn btn-primary like <?= $isLiked ? 'is_liked' : '' ?>" type="submit" name="like"><i class="material-icons">favorite</i>Tetszik</button>
                <button class="btn "><i class="material-icons">share</i>Megosztás</button>
            </div>
            <hr id="sidehr">
            <div class="description">
                <p><?= $uploadedMusic->description ?></p>
            </div>

            <br>
            <p>
                <strong>Kiadás éve: </strong><?= $uploadedMusic->writeyear ?><br>
                <strong>Hangszer: </strong><?= $instrument->getItemBy('id', $uploadedMusic->instrument_id)->instrument_name ?><br>
                <strong>Múfaja: </strong><?= $category->getItemBy('id', $uploadedMusic->genre_id)->category ?><br>
            </p>
        </div>
        <div class="setcomment">
            <?php if ($user) : ?>
                <form method="post">
                    <input type="text" name="date" hidden value="<?= date('Y-m-d H:i:s') ?>">
                    <label for="comment">Véleményezze a kottát: </label>
                    <input type="text" hidden name="music_id" value="<?= $uploadedMusic->id ?>">
                    <input type="text" name="comment" required>
                    <input type="submit" class="btn" value="Küldés" name="submit_comment">
                </form>

            <?php endif; ?>
        </div>
        <?php if ($comments) : ?>
            <div class="comment-section">
                <h6>Kommentek:</h6>
                <hr>
                <?php foreach ($comments as $comment) : ?>
                    <div class="comment-border">
                    <form method="post">
                    <input type="text" hidden name="comment_id" value="<?= $comment->id ?>">
                         <div class="comment">
                           <div class="comment-image">
                               <img src="../files/users/<?= $SheetByUser->getItemById($comment->user_id)->img ?>" >
                           </div>     <span class="user"> <?= $SheetByUser->getItemById($comment->user_id)->username ?> </span>      <span class="date">  <?= str_replace('-', ".", $comment->date) ?></span>
                           <p>
                           <?= $comment->comment ?>

                           </p>
                         </div>
                        <?php if ($user) : ?>
                            <?php if ($SheetByUser->id == $comment->user_id) : ?>
                                <div class="input">
                                <input type="submit" name="update_comment" value="Szerkesztés">
                                    <input type="submit" name="delete_comment" value="Törlés">
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </form>
                    </div>
                    
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php if ($user) : ?>
    <script>
        $(document).ready(function() {

            async function postData(url = '', data = {}) {
                const response = await fetch(url, {
                    method: 'POST',
                    cache: 'no-cache',
                    headers: {
                        'Content-Type': 'application/json',
                        "Access-Control-Allow-Origin": "*",
                        "Access-Control-Allow-Credentials": true
                    },

                    body: JSON.stringify(data)
                });
                return response.json();
            }

            setTimeout(function() {
                console.log('Mentés a legutóbbi kották közé...');
                postData('addToRecent.php', {
                    sheet_id: <?= $uploadedMusic->id ?>
                }).then(response => {
                    console.log(response);
                    if (response.success) {
                        console.log('Sikeres mentés!');
                    } else {
                        console.log('A mentés sikertelen.b');
                    }
                });
            });

            let sheet_has_liked = <?= $isLiked ? "true" : "false" ?>;
            $('button.like').click(function() {
                if (!sheet_has_liked)
                    postData('like.php', {
                        action: "like",
                        sheet_id: <?= $uploadedMusic->id ?>
                    }).then(function(response) {
                        if (response.success) {
                            $('button.like').addClass('is_liked');
                            sheet_has_liked = !sheet_has_liked;
                        }
                    })
                else
                    postData('like.php', {
                        action: "unlike",
                        sheet_id: <?= $uploadedMusic->id ?>
                    }).then(function(response) {
                        if (response.success) {
                            $('button.like').removeClass('is_liked');
                            sheet_has_liked = !sheet_has_liked;
                        }
                    })


            });
        });
    </script>
<?php endif; ?>


<div class="embed">
    <?= $uploadedMusic->embed ?>
</div>