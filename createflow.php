<?php

require_once __DIR__ . '/lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');
?>
<div class="container" style="padding-top: 30px;">
    <div class="split left">
        <h1 class="splitTitle1">Alkotó</h1>
        <a href="artist/create.php" class="button1">Töltsön fel</a>
    </div>
    <h1 id="title">Mit szeretne feltölteni?</h1>
    <div class="split right">
        <h1 class="splitTitle2" style="left:42%">Kotta</h1>
        <a href="music/create.php" class="button2">Töltsön fel</a>
    </div>
</div>