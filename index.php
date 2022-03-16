<?php

require_once __DIR__ . '/lib/autoload.php';

new App\Template('Sheetstack Főoldal', 'home_layout');
include './views/components/sheets_item.php';

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;
$uploadMusic = new App\Models\UploadedMusic;
$artist = new App\Models\Artist;

$recommended_sheets = $uploadMusic->all();
$recent_sheets = $user->getRecentSheets();

$liked_sheets = $user->getLikedSheets();


?>
<?php if (!empty($recent_sheets)) : ?>
    <section class="section home">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Folytasd a tanulást</h1>
                    <?php foreach ($recent_sheets as $sheet) : ?>
                        <div class="play_sheet" onclick="document.navigateTo('/music/<?= $sheet["slug"] ?>')">
                            <a href="/music/<?= $sheet["slug"] ?>" class="play_button"><i class="material-icons">play_arrow</i></a>
                            <div class="meta">
                                <h4>
                                    <b><?= $sheet["title"] ?></b>
                                </h4>
                                <p>
                                    <b><?= $artist->getItemById($sheet["author_id"])->name ?></b>
                                </p>
                                <p class="last-practise">
                                    Utolsó gyakorlás: <?= $sheet["date"] ?> <?= $sheet["time"] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </section>
<?php endif ?>
<main class="container">
    <div class="container my-4">
        <h2>Ajánlott kották</h2>

        <div class="row my-2">
            <?php
            foreach ($recommended_sheets as $sheet) {
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $sheet->title,
                    'author_name'   => $artist->getItemBy('id', $sheet->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $sheet->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $sheet->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $sheet->slug,
                    'user_id'       => $user->id
                ]);
            }
            ?>
        </div>
    </div>
    <div class="container my-4">
        <h2>Kedvelt kották</h2>

        <div class="row my-2">
            <?php
            foreach ($liked_sheets as $sheet) {
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $sheet->title,
                    'author_name'   => $artist->getItemBy('id', $sheet->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $sheet->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $sheet->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $sheet->slug,
                    'user_id'       => $user->id
                ]);
            }
            ?>
        </div>
    </div>

</main>