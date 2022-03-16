<?php

require_once __DIR__ . '/lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');
?>
<style>
    body{
        padding: 0;
    }
</style>
  <div class="container home-container">
            <div class=" split left">
                <h1>Alkotó</h1>
                <a href="artist/create.php" class="button1">töltsön fel</a>
            </div>
            <div class="split right">
                <h1 class="white">Kotta</h1>
                <a href="music/create.php" class="button1 white">Töltsön fel</a>
            </div>
        </div>