<?php

use App\Helper;

require_once __DIR__ . '/../lib/autoload.php';

new App\Template();

if (Helper::isAuth()) header('Location: /');

if (isset($_POST["userlogin"])) {
    $LoginController = new App\Controllers\LoginController;

    $LoginController->Get_user($_POST['email'], $_POST['passwd']);
}

?>
<div class="container my-5" style="max-width:500px!important;">
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszava:</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwd">
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3" name="userlogin">Bejelentkezés</button>
        <div>
            <div class="float-left"><a class="card-link " href="register.php">Regisztráció</a></div>
        </div>
    </form>
</div>