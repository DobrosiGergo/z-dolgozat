<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Sheetstack Alkotó Módosítás', 'empty');

use App\Helper;
use App\Models\User;
use App\Tools;

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

$artistNamespace = new App\Models\Artist;
$artistItem = $artistNamespace->getItemById($_GET['id']);


if(isset($_POST['upload'])){
$artistUpdate = new App\Models\Artist;
$artistUpdate->update($_POST);
}

if(!Helper::isAuth()){
Tools::flashMessage('Előbb jelentkezzen be!!', 'danger');
header("Location:/");
}
?>
                   <?php foreach($artistItem as $artist):?>
<div class="container my-5">
    <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
        <div class="card  card-body" style="width: 50rem; ">
            <h3 class="card-title text-center">Módosítás</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="artist_id">Alkotó</label>
                    <input type="text" name="author_name" class="form-control w-50 align-items-center" value="<?=$artist->author_name?>" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési országa:</label>
                    <input type="text" name="country_name" value="<?= $artist->country_name?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési városa:</label>
                    <input type="text" name="country_name" value="<?= $artist->city_name?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak születési éve:</label>
                    <input type="number" name="born_age" value="<?= $artist->born_age?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Az alkotónak halálának éve:</label>
                    <input type="number" name="death_age" value="<?= $artist->death_age?>" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <div class="mb-3">
                    <label for="stilus">Műfaja</label>
                    <select class="form-select w-50" aria-label="Default select example" name="category_id">
                        <option selected disabled class="dropdown-text w-50">Kategória</option>
                        <option value="<?= $artist->category_id ?>" class="dropdown-text w-50"> <?= $categories->getItemById($artist->category_id)->category?></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stilus">Hangszere</label>
                    <select class="form-select w-50" aria-label="Default select example" name="instrument_id">
                        <option selected disabled class="dropdown-text w-50">Hangszer</option>
                            <option value="<?= $artist->instrument_id ?>" class="dropdown-text w-50"> <?= $instruments->getItemById($artist->instrument_id)->instrument_name?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput">Leírás</label>
                  <textarea name="description"  cols="30" rows="10"><?=$artist->description?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label"> Válasszon ki egy képet a borítónak</label>
                    <input class="form-control form-control-sm" id="formFileSm" name="img" type="file" value="<?=$artist->img?>" required>
                </div>
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Módosítás" name="upload" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>