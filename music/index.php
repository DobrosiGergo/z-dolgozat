<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Sheetstack Kották','home_layout');


$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$uploadedMusic = new App\Models\UploadedMusic;
$artist = new App\Models\Artist;

if (isset($_POST['search'])) {
    $sheets = new App\Models\UploadedMusic;
}
require_once '../views/components/sheets_item.php';


?>


<div class="container my-5" style="display: inline-flex;">
    <?php foreach ($instruments->all() as $instrument) : ?>
        <div class="row col-xs-2" style="  display:flex; background-color:beige;border-radius:50%; width:134px; margin-left:20px; justify-content:space-between;">
            <a href="main.php?id=<?= $instrument->id ?>"><img style="width: 90px; height: 80px" class="rounded" src="../files/instrument icons/<?= $instrument->image ?>" alt="<?= $instrument->instrument_name ?>"></a>
        </div>
    <?php endforeach ?>
</div>
<div class="container my-5 dropdown">
    <label for="seatchBtn" class="dropdown-label">Szűrés</label>
    <label for="select" class="dropdown-label">A legnépszerűbbek</label>
    <form method="post" class="form">
        <select class="form-select form-select-lg w-25 mb-3 dropdown-item" aria-label=".form-select-lg example" id="select">
            <option selected disabled class="dropdown-text">Műfajok</option>
            <?php foreach ($categories->all() as $category) : ?>
                <option value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
            <?php endforeach ?>
        </select>
        <input type="button" value="Klasszikus" name="classic" class="searchBtn" style="margin-left:200px">
        <input type="button" value="Rock" name="rock" class="searchBtn">
        <input type="button" value="Jazz" name="jazz" class="searchBtn">
        <input type="button" value="Country" name="country" class="searchBtn">
    </form>
</div>

<div class="container my-5">
    <div class="row">

        <?php
        foreach ($uploadedMusic->all() as $uploadedMusic) {
            sheet_item([
                'img_url'       => '/files/images/sheet_img.jpg',
                'title'         => $uploadedMusic->title,
                'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                'page_number'   => 4,
                'url'           => '/music/' . $uploadedMusic->slug
            ]);
        }
        ?>
    </div>
</div>
<br>