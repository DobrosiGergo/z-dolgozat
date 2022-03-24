<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Kották', 'with_header');


$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$uploadedMusic = new App\Models\UploadedMusic;
$artist = new App\Models\Artist;

require_once '../views/components/sheets_item.php';

$genre_filter = isset($_GET['genre']) ? $_GET['genre'] : 0;
$instrument_filter = isset($_GET['instrument']) ? $_GET['instrument'] : 0;

$filter = $genre_filter || $instrument_filter;
$filters = [];
if ($filter) {

    if ($genre_filter)
        $filters["genre_id"] = $genre_filter;

    if ($instrument_filter)
        $filters["instrument_id"] = $instrument_filter;

    $uploadedMusic = $uploadedMusic->filter($filters);
} else {
    $uploadedMusic = $uploadedMusic->all();
}

?>


<div class="index_filter fullwidth">
    <div class="wrapper">
        <div class="container">
            <h6 class="title">
                Szűrés
            </h6>
            <form method="get" class="form filter_form">
                <select class="form-select  dropdown-item" name="genre">
                    <option class="dropdown-text" value="0">Összes műfaj</option>
                    <?php foreach ($categories->all() as $category) : ?>
                        <option <?php if ($genre_filter == $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
                    <?php endforeach ?>
                </select>
                <select class="form-select  dropdown-item" name="instrument">
                    <option class="dropdown-text" value="0">Összes hangszer</option>
                    <?php foreach ($instruments->all() as $instrument) : ?>
                        <option <?php if ($instrument_filter == $instrument->id) echo 'selected' ?> value="<?= $instrument->id ?>" class="dropdown-text"><?= $instrument->instrument_name ?></option>
                    <?php endforeach ?>
                </select>
            </form>
        </div>
    </div>
</div>




<div class="sheet-items my-4" style="display:inline-block;">
    <div class="row">

        <?php
        if ($uploadedMusic) {
            foreach ($uploadedMusic as $uploadedMusic) {
                $ownsByTheUserBool = $user ? $uploadedMusic->ownsByTheUser($user->id) : false;
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $uploadedMusic->title,
                    'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                    'url'           => '/music/' . $uploadedMusic->slug,
                    'auth' =>  $ownsByTheUserBool
                ]);
            }
        } elseif ($filter) {
            echo "<p>Nincs a szűrésnek megfelelő elem</p>";
        }
        ?>
    </div>
</div>