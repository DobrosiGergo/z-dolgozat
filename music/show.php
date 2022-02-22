<?php

require_once __DIR__ . '/../lib/autoload.php';


new App\Template('Sheetstack Alkotók', 'empty');


use App\Models\UploadedMusic;


$uploadedMusicNamespace = new UploadedMusic;

$uploadedMusic = $uploadedMusicNamespace->getItemBy('slug', $_GET['slug']);

if (!$uploadedMusic) {
    echo 'Nincs ilyen feltöltött mű az adatbázisunkban...';
    return false;
}
?>

<h1><?= $uploadedMusic->title ?></h1>

<div class="embed">
    <?= $uploadedMusic->embed ?>
</div>