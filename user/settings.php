<?php

use App\Helper;

require_once __DIR__ . '/../lib/autoload.php';
require_once '../views/components/sheets_item.php';
require_once '../views/components/artist_item.php';

new App\Template($user->username, 'profile');
global $user;
if (!Helper::isAuth()) header('Location: /');

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
?>
<main class="container">
    <div class="container my-5">
    <h3>Profil beállításaim</h3>

        <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
            <div class="card  card-body" style="width: 50rem; ">
            <h6>Itt a felhasználói adatokat tudja megváltoztatni.</h6>
                <div class="form-group">
                    <label for="username">Felhasználó név:</label>
                    <input type="text" name="title" class="form-control w-50 align-items-center" value="<?= $user->username ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">teljes név:</label>
                    <input type="text" name="title" class="form-control w-50 align-items-center" value="<?= $user->fullname ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="text" name="title" class="form-control w-50 align-items-center" value="<?= $user->email ?>" required>
                </div>
                <div class="mb-3">
                        <label for="stilus">Műfaja</label>
                        <select class="form-select w-50" aria-label="Default select example" name="category_id">
                            <?php foreach ($categories->all() as $category) : ?>
                                <option <?php if ($user->category_id== $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stilus">Hangszere</label>
                        <select class="form-select w-50" aria-label="Default select example" name="instrument_id">
                            <?php foreach ($instruments->all() as $instrument) : ?>
                                <option <?php if ($user->instrument_id == $instrument->id) echo 'selected' ?> value="<?= $instrument->id ?>" class="dropdown-text"><?= $instrument->instrument_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Felhasználói Adatok Módosítása" name="userupdate" />
                </div>
            </div>
            
        </div>
    </div>
    <div class="container my-5">
        <div style="margin:  0 auto; width: 100%; max-width:500px; margin-left:100px; padding-top:50px;">
            <div class="card  card-body" style="width: 50rem; ">
            <h6>Itt tudja a jelszavát megvátoztatni.</h6>
                <div class="form-group">
                    <label for="username">Új jelszó:</label>
                    <input type="password" name="password" class="form-control w-50 align-items-center" value="" required>
                </div>
                <div class="form-group">
                    <label for="username">Új jelszó megerősítése:</label>
                    <input type="password" name="password2" class="form-control w-50 align-items-center" value="" required>
                </div>
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary my-3 w-100" value="Jelszó módosítás" name="passwordupdate" />
                </div>

            </div>
        </div>
    </div>
</main>