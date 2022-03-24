<?php

require_once '../lib/autoload.php';

new App\Template('Alkotók', 'with_header');
$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$artist = new App\Models\Artist;
include '../views/components/artist_item.php';
global $user;
$category_filter = isset($_GET['category']) ? $_GET['category'] : 0;
$instrument_filter = isset($_GET['instrument']) ? $_GET['instrument'] : 0;

$artistCollection = null;

$filter = $category_filter || $instrument_filter;

$filters = [];

if ($filter) {
    if ($category_filter) {
        $filters['category_id'] = $category_filter;
    }
    if ($instrument_filter) {
        $filters['instrument_id'] = $instrument_filter;
    }

    $artistCollection = $artist->filter($filters);
} else {
    $artistCollection = $artist->all();
}

?>

<div class="index_filter fullwidth">
    <div class="wrapper">
        <div class="container">
            <h6 class="title">
                Szűrés
            </h6>
            <form method="get" class="form filter_form">
                <select class="form-select  dropdown-item" name="category">
                    <option class="dropdown-text" value="0">Összes műfaj</option>
                    <?php foreach ($categories->all() as $category) : ?>
                        <option <?php if ($category_filter == $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
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

<div class="sheet-items my-4">
    <div class="row">

        <?php
        if ($artistCollection)
        foreach ($artistCollection as $artist) {
            $ownsByTheUserBool = $user ? $artist->ownsByTheUser($user->id) : false;
            artist_item([
               'name' => $artist->name,
               'img_url' => '/files/artist/'.$artist->img,
               'url' => '/artist/'.$artist->slug,
                'auth' =>  $ownsByTheUserBool
            ]);
        }
        elseif ($filter)
            echo "Nincs a szűrésnek megfelelő elem";
        else
            echo "Nincs elérhető elem";
        ?>
    </div>
</div>