<?php 

use App\Helper;
use App\Tools;

require_once __DIR__ . '/../lib/autoload.php';

new App\Template();
$passreset= new App\Models\User;

if (Helper::isAuth()) header('Location: /');
if(isset($_POST['forgot'])){
$passreset->ResetPassword($_POST);
}
?>
<main class="container">
<div class="container my-5" style="max-width:500px!important;">
    <div class="card card-body">
        <h3 class="card-title text-center" >Elfelejtett jelszó</h3>
        <form method="post">
            <div class="mb-3 ">
                <label class="form-label" for="email">Adja meg az e-amil címét!</label>
                <input class="form-control" type="email" id="email" name="email"  placeholder="@" required/>
            </div>
            <button type="submit" name="forgot" class="btn btn-primary w-100 my-3">Elküld</button>
            <div>
                <div style="float:left;"><a href="login.php">Bejelentkezés</a></div>
                <div style="float:right;"><a href="register.php">Regisztráció</a></div>
            </div>
        </form>
    </div>
</div>
</main>