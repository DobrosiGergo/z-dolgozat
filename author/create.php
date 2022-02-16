<?php

require_once '../lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');
$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
?>
<div class="container my-5">
    <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px">
        <div class="card  card-body" style="width: 50rem; ">
            <h3 class="card-title text-center">Feltöltés</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="formGroupExampleInput">Név:</label>
                    <input type="text" name="author_name" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                </div>
                <br>    
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Rövid leírás:</label>
                    <textarea class="form-control w-50" name="shortdescription" id="exampleFormControlTextarea1" style="height: 5vh;" rows="3" maxlength="350" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Leírás: </label>
                    <textarea class="form-control w-50" name="description" id="exampleFormControlTextarea1" style="height: 20vh;" rows="3" maxlength="350" required></textarea>
                </div>
                <br>
                <div class="mb-3">
                    <label for="kategoria">Válasszon ki egy műfajt</label>
                    <select class="form-select w-50" aria-label="Default select example" name="select">
                    <option selected disabled class="dropdown-text w-50">Műfajok</option>
                    <?php foreach ($categories->all() as $category) : ?>
                        <option value="<?= $category['id'] ?>" class="dropdown-text"><?= $category['category'] ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleCountry">Adja meg hol él(t) (ország):</label>
                    <input type="text" name="country_name" class="form-control w-50 align-items-center" id="formGroupExampleCountry" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleCity">Adja meg hol él(t) (város):</label>
                    <input type="text" name="city_name" class="form-control w-50 align-items-center" id="formGroupExampleCity" required>
                </div>

                <div class="mb-3">
                    <label for="stilus">Válasszon ki egy hangszert</label>
                    <select class="form-select w-50" aria-label="Default select example" name="select2">
                        <option selected disabled class="dropdown-text w-50">Hangszer</option>
                        <?php foreach ($instruments->all() as $instument) : ?>
                            <option value="<?= $instument['id'] ?>" class="dropdown-text w-50"><?= $instument['instrument_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleBorn">Születési ideje (évben)</label>
                    <input type="number" name="author_name" class="form-control w-50 align-items-center" id="formGroupExampleBorn" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleDeath">halálának ideje (évben)</label>
                    <input type="number" name="author_name" class="form-control w-50 align-items-center" id="formGroupExampleDeath" required>
                </div>
                
                <div class="mb-3">
                    <label for="formFileSm" class="form-label"> Válasszon ki egy képet a borítónak</label>
                    <input class="form-control form-control-sm" id="formFileSm" name="file3" type="file" required>
                </div>
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Feltöltés" name="upload" />
                </div>
            </form>
        </div>
    </div>
</div>