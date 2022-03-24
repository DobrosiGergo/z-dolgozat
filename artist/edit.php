<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Sheetstack Alkotó Módosítás', 'empty');

use App\Helper;
use App\Models\User;
use App\Tools;

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

$artistNamespace = new App\Models\Artist;
$artistItem = $artistNamespace->getItemBy('slug',$_GET['slug']);
if(isset($_POST['update'])){
$artistUpdate = new App\Controllers\ArtistController;
$artistUpdate->UpdateArtist($_POST);
header("Location:/");
}

if(!Helper::isAuth()){
Tools::flashMessage('Előbb jelentkezzen be!!', 'danger');
header("Location:/");
}
?>
<div class="container my-5">
    <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
        <div class="card  card-body" style="width: 50rem; ">
            <h3 class="card-title text-center">Módosítás</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="artist_id">Alkotó</label>
                    <input type="text" name="name" class="form-control w-50 align-items-center" value="<?=$artistItem->name?>" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési országa:</label>
                    <input type="text" name="country_name" value="<?= $artistItem->country_name?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési városa:</label>
                    <input type="text" name="city_name" value="<?= $artistItem->city_name?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési éve:</label>
                    <input type="number" name="born_age" value="<?= $artistItem->born_age?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak halálának éve:</label>
                    <input type="number" name="death_age" value="<?= $artistItem->death_age?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="mb-3">
                    <label for="stilus">Műfaja</label>
                    <select class="form-select w-50" aria-label="Default select example" name="category_id">
                    <?php foreach($categories->all() as $category) : ?>
                            <option <?php if ($artistItem->category_id == $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stilus">Hangszere</label>
                    <select class="form-select w-50" aria-label="Default select example" name="instrument_id">
                    <?php foreach($instruments->all() as $instrument) : ?>
                        <option <?php if ($artistItem->instrument_id == $instrument->id) echo 'selected' ?> value="<?= $instrument->id ?>" class="dropdown-text"><?= $instrument->instrument_name ?></option>
                        <?php endforeach;?>        
                    </select>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput">Leírás</label>
                  <textarea name="description"  cols="30" rows="10"><?=$artistItem->description?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label"> Válasszon ki egy képet a borítónak</label>
                    <input class="form-control form-control-sm" id="formFileSm" name="img" type="file" value="<?=$artistItem->img?>" >
                </div>
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Módosítás" name="update" />
                </div>
                <input type="text" name="id" hidden value="<?=$artistItem->id?>">
            </form>
        </div>
    </div>
</div>
