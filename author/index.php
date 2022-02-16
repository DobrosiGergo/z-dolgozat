<?php

require_once '../lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');
$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

?>
<div class="container my-5" style="display: inline-flex;">
    <?php foreach ($instruments->all() as $instrument) : ?>
        <div class="row col-xs-2" style="  display:flex; background-color:beige;border-radius:50%; width:134px; margin-left:20px; justify-content:space-between;">
            <a href="main.php?id=<?= $instrument['id'] ?>"><img style="width: 90px; height: 80px" class="rounded" src="../files/instrument icons/<?= $instrument["image"] ?>" alt="<?= $instrument["instrument_name"] ?>"></a>
        </div>
    <?php endforeach ?>
</div>
<div class="container my-5 dropdown">
    <label for="seatchBtn" class="dropdown-label">Szűrés</label>
    <label for="select" class="dropdown-label">A legnépszerűbbek</label>
    <form method="post" class="form">
        <select class="form-select form-select-lg w-25 mb-3 dropdown-item" aria-label=".form-select-lg example" id="select">
            <option selected disabled class="dropdown-text">Műfajok</option>
            <?php foreach ($categories->all() as $category) : ?>
                <option value="<?= $category['category'] ?>" class="dropdown-text"><?= $category['category'] ?></option>
            <?php endforeach ?>
        </select>
        <input type="button" value="Klasszikus" name="classic" class="searchBtn" style="margin-left:200px">
        <input type="button" value="Rock" name="rock" class="searchBtn">
        <input type="button" value="Jazz" name="jazz" class="searchBtn">
        <input type="button" value="Country" name="country" class="searchBtn">
    </form>
</div class="container my-5">
    <div class="card mb-3" style="border:solid 1px blue; padding:10px">
        <img class="card-img-top" src="../files/images/chopin.jfif" style="width:225px; height:150px;" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Frédéric Chopin</h5>
            <p class="card-text">A Varsói Hercegség Mazovia tartományában, a Sochaczew város melletti Żelazowa Wolában született. Bár a születés után hetekkel kitöltött anyakönyvben február 22. szerepel, a család március 1-jét tekintette születésnapjának. Édesapja, Mikołaj (Nicolas) Chopin (1771–1844) francia bevándorló, édesanyja, Tekla Justyna Krzyżanowska (1782–1861) lengyel volt. Egy nővére és két húga volt Chopinnek: Ludwika (1807–1855), Izabela (1811–1881) és Emilia (1812–1827). Néhány hónappal Fryderyk születése után a család Varsóba költözött, ahol a családfő franciatanárként dolgozott.
            </p>
            <p class="card-text"><small class="text-muted">Élt: 1810-1849</small></p>
            <p class="card-text"><small class="text-muted">Műfaja: Klasszikus</small></p>
            <p class="card-text"><small class="text-muted">Hangszer: Zongora</small></p>
            <a class="btn btn-primary" href="./artist.php">Megnézem</a>

        </div>
<div>

</div>