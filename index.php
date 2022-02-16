<?php

require_once './lib/autoload.php';

new App\Template('Sheetstack Főoldal', 'empty');


$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
if(isset($_POST['search'])){
$sheets = new App\Models\Music;
}


?>


<div class="container">
    <div class="split left">
<h1 class="splitTitle1">Alkotók</h1>
<a href="author/index.php" class="button1">Nézze meg</a>
    </div>
    <div class="split right">
<h1 class="splitTitle2">Elérhető kották</h1>
<a href="music/index.php" class="button2">Nézze meg</a>
    </div>
</div>
