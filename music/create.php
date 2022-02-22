<?php

require_once __DIR__ . '/../lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');

use App\Helper;
use App\Models\User;
use App\Tools;

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

$artistNamespace = new App\Models\Artist;

if (isset($_POST['upload'])) {
    $sheet = new App\Controllers\SheetController;
    $sheet->InsertSheet($_POST);
}
if(!Helper::isAuth()){
Tools::flashMessage('Előbb jelentkezzen be!!', 'danger');
header("Location:/");
}
?>
<div class="container my-5">
    <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
        <div class="card  card-body" style="width: 50rem; ">
            <h3 class="card-title text-center">Feltöltés</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="artist_id">Alkotó</label>
                    <select class="form-select w-50" aria-label="Default select example" name="artist_id">
                        <option selected disabled class="dropdown-text w-50">Válasszon ki egy alkotót</option>
                        <?php foreach ($artistNamespace->all() as $artist) : ?>
                            <option value="<?= $artist->id ?>" class="dropdown-text w-50"><?= $artist->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">A darabnak a címe</label>
                    <input type="text" name="title" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput">Leírás</label>
                    <input type="text" name="description" class="form-control w-50 align-items-center" id="formGroupExampleInput">
                </div>



                <div class="mb-3">
                    <label for="stilus">Műfaj</label>
                    <select class="form-select w-50" aria-label="Default select example" name="genre_id">
                        <option selected disabled class="dropdown-text w-50">Kategória</option>
                        <?php foreach ($categories->all() as $category) : ?>
                            <option value="<?= $category->id ?>" class="dropdown-text w-50"><?= $category->category ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stilus">Milyen hangszerre írták a darabot?</label>
                    <select class="form-select w-50" aria-label="Default select example" name="instrument">
                        <option selected disabled class="dropdown-text w-50">Hangszer</option>
                        <?php foreach ($instruments->all() as $instument) : ?>
                            <option value="<?= $instument->id ?>" class="dropdown-text w-50"><?= $instument->instrument_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleBorn">Keletkezési éve (*nem muszáj kitöltenie)</label>
                    <input type="number" name="writeyear" class="form-control w-50 align-items-center" id="formGroupExampleBorn">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Embed kód:</label>
                    <textarea class="form-control w-50" name="embed" id="exampleFormControlTextarea1" style="height: 5vh;" rows="3" maxlength="350" required></textarea>
                </div>
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Feltöltés" name="upload" />
                </div>
            </form>
        </div>
    </div>
</div>