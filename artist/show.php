<?php

require_once __DIR__ . '/../lib/autoload.php';


new App\Template('Sheetstack Alkotók', 'empty');

include '../views/components/sheets_item.php';

use App\Models\Artist;
use App\Models\Category;
use App\Models\Instruments;
use App\Models\UploadedMusic;

$artistNamespace = new Artist;
$instrumentsNamespace = new Instruments();
$categoryNamespace = new Category();
$uploadedMusicNamespace = new UploadedMusic;

$artist = $artistNamespace->getItemBy('slug', $_GET['slug']);

if (!$artist) {
    echo 'Nincs ilyen alkotó az adatbázisunkban...';
    return false;
}

?>
<div class="row artist-details">
    <div class="col col-sm-3">
        <img src="../files/artist/<?= $artist->img ?>" alt="<?= $artist->name ?>">
    </div>
    <div class="col">

        <h1 class="mt-0"><?= $artist->name ?></h1>
        <h5><?= $artist->born_age . ' - ' . $artist->death_age ?></h5>

        <p> <i><?= $artist->country_name ?>, <?= $artist->city_name ?></i></p>
        <p><?= $artist->description ?> </p>

        <p>Hangszer: <?= $instrumentsNamespace->getItemById($artist->instrument_id)->instrument_name ?></p>

        <p>Műfaj: <?= $categoryNamespace->getItemById($artist->category_id)->category ?></p>
    </div>
</div>

<hr>

<div class="container my-5">
    <h3>Az elérhető kották:</h3>
    <div class="sheet-items">
        <div class="row">

            <?php

            $uploadedMusicArray = $uploadedMusicNamespace->getItemsBy('artist_id', $artist->id);

            if (!$uploadedMusicArray) {
                echo 'A szerzőhöz jelenleg nincs feltöltve egy mű sem.';
                die();
            }



            foreach ($uploadedMusicArray as $music) {

                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $music->title,
                    'author_name'   => $artist->name,
                    'author_url'    => $artist->slug,
                    'genre'         => $categoryNamespace->getItemById($music->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $music->slug
                ]);
            }
            ?>
        </div>
    </div>
</div>