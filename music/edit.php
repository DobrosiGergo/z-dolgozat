<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Sheetstack Alkotó Módosítás', 'empty');

use App\Helper;
use App\Models\User;
use App\Tools;
use App\Controllers\SheetController;
$musicNameSpace = new App\Models\UploadedMusic;
$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$artist = new App\Models\Artist;
$music = $musicNameSpace->getItemBy('slug',$_GET['slug']);

if (!$music) {
    echo "Nincsen ilyen Alkotás feltöltve";
    die();
}
if (isset($_POST['upload'])) {
    $updateSheet = new App\Controllers\SheetController;
   $updateSheet->UpdateSheet($_POST);
   header("Location:/");

}

if (!Helper::isAuth()) {
    Tools::flashMessage('Előbb jelentkezzen be!!', 'danger');
    header("Location:/");
}
?>
<div class="container my-5">
    <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
        <div class="card  card-body" style="width: 50rem; ">
            <h3 class="card-title text-center">Módosítás</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="artist_id">Alkotás Címe:</label>
                    <input type="text" name="title" class="form-control w-50 align-items-center" value="<?= $music->title ?>" required>
                </div>
                <div class="form-group">
                    <label for="artist_id">Alkotója:</label>
                    <select class="form-select w-50" aria-label="Default select example" name="artist_id">
                        <?php foreach ($artist->all() as $artistItem) : ?>
                            <option <?php if ($music->artist_id == $artistItem->id) echo 'selected' ?> value="<?= $artistItem->id ?>" class="dropdown-text"><?= $artistItem->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Az alkotás keletkezési ideje:</label>
                        <input type="number" name="writeyear" value="<?= $music->writeyear ?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="stilus">Műfaja</label>
                        <select class="form-select w-50" aria-label="Default select example" name="category_id">
                            <?php foreach ($categories->all() as $category) : ?>
                                <option <?php if ($music->genre_id == $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stilus">Hangszere</label>
                        <select class="form-select w-50" aria-label="Default select example" name="instrument_id">
                            <?php foreach ($instruments->all() as $instrument) : ?>
                                <option <?php if ($music->instrument_id == $instrument->id) echo 'selected' ?> value="<?= $instrument->id ?>" class="dropdown-text"><?= $instrument->instrument_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label >Leírás: </label>
                    <div class="form-group">
                        <textarea name="description" id="" cols="30" rows="10"><?= $music->description?></textarea>
                    </div>
                    <label for="formGroupExampleInput1">Embed kód:</label>
                    <div class="form-group">
                        <textarea name="embed" cols="50" rows="10" id="FormGroupExampleInput1"><?= $music->embed ?></textarea>
                    </div>
                    <div class="input-group-prepend">
                        <input type="submit" class="btn btn-primary my-3 w-100" value="Módosítás" name="upload" />
                    </div>
                    <input type="text" name="id" value="<?= $music->id ?>" hidden>
            </form>
        </div>
    </div>
</div>