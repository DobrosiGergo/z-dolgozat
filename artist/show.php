<?php

require_once __DIR__ . '/../lib/autoload.php';


new App\Template('Sheetstack Alkotók', 'empty');

include '../views/components/sheets_item.php';



$artist = new App\Models\Artist;
$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$uploadedMusic = new App\Models\UploadedMusic;

$artist = $artist->getItemBy('slug', $_GET['slug']);
if($artist->death_age == 0){
$artist->death_age = "Mai napig";
}


if (!$artist) {
    echo 'Nincs ilyen alkotó az adatbázisunkban...';
    return false;
}

$genre_filter = isset($_GET['genre']) ? $_GET['genre'] : 0;
$instrument_filter = isset($_GET['instrument']) ? $_GET['instrument'] : 0;
$artist_filter = $artist->id;

$filter = $genre_filter || $instrument_filter;

$filters = [];
$filters["artist_id"] = $artist_filter;

if ($filter) {

    if ($genre_filter)
        $filters["genre_id"] = $genre_filter;

    if ($instrument_filter)
        $filters["instrument_id"] = $instrument_filter;
}
$uploadedMusic = $uploadedMusic->filter($filters);
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

        <p>Hangszer: <?= $instruments->getItemById($artist->instrument_id)->instrument_name ?></p>

        <p>Műfaj: <?= $categories->getItemById($artist->category_id)->category ?></p>
    </div>
</div>


<div class="container my-3">
    <div class="index_filter boxed">
        <div class="wrapper">
            <div class="container">
                <h6 class="title">
                    Szűrés
                </h6>
                <form method="get" class="form filter_form">
                    <select class="form-select dropdown-item" name="genre">
                        <option class="dropdown-text" value="0">Összes műfaj</option>
                        <?php foreach ($categories->all() as $category) : ?>
                            <option <?php if ($genre_filter == $category->id) echo 'selected' ?> value="<?= $category->id ?>" class="dropdown-text"><?= $category->category ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="form-select  dropdown-item" name="instrument">
                        <option class="dropdown-text" value="0">Összes hangszer</option>
                        <?php foreach ($instruments->all() as $instrument) : ?>
                            <option <?php if ($instrument_filter == $instrument->id) echo 'selected' ?> value="<?= $instrument->id ?>" class="dropdown-text"><?= $instrument->instrument_name ?></option>
                        <?php endforeach ?>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="sheet-items my-4">
        <div class="row">

            <?php

            if (!$uploadedMusic) {
                if ($filter) {
                    echo 'Ilyen szűrési paraméterekkel nem találtunk alkotást';
                    die();
                }
                echo 'A szerzőhöz jelenleg nincs feltöltve egy mű sem.';
                die();
            }

            foreach ($uploadedMusic as $music) {

                $ownsByTheUserBool = $user ? $music->ownsByTheUser($user->id) : false;
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $music->title,
                    'author_name'   => $artist->getItemBy('id', $music->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $music->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $music->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $music->slug,
                    'auth' =>  $ownsByTheUserBool
                ]);
            }
            ?>
        </div>
    </div>
</div>