<?php

require_once __DIR__ . '/../lib/autoload.php';
new App\Template();

use App\Controllers\RegisterController;

if (App\Helper::isAuth()) header('Location: /');

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;


if (isset($_POST["userregist"])) {
    $user = new RegisterController();
    $user->InsertUser($_POST);
}



?>
<div class="container my-5" style="max-width:500px!important;">
    <form method="POST">
        <h3 class="card-title text-center">Regisztráció</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Felhasználónév:</label>
            <input type="text" class="form-control" id="exampleInputText1" aria-describedby="emailHelp" name="username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputText2">Teljes név:</label>
            <input type="text" class="form-control" id="exampleInputText2" aria-describedby="emailHelp" name="fullname" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszava:</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwd">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszó megerősítés:</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="passwd2">
        </div>
        <br>
        <div class="form-group">
            <select class="form-select" name="instrument" aria-label="Default select example">
                <option selected disabled>Kedvenc hangszere</option>
                <?php foreach ($instruments->all() as $instruments) : ?>
                    <option value="<?= $instruments->id ?>" name="instrument"><?= $instruments->instrument_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <select class="form-select" name="category" aria-label="Default select example">
                <option selected disabled>Kedvenc zenei műfaja</option>
                <?php foreach ($categories->all() as $category) : ?>
                    <option value="<?= $category->id ?>" name="category"><?= $category->category ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100 my-3" name="userregist">Regisztráció</button>
        <div>
            <div class="float-left"><a class="card-link " href="login.php">Bejelentkezés</a></div>
        </div>
    </form>
</div>