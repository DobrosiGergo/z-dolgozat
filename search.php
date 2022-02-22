<?php
require_once __DIR__ . '/lib/autoload.php';

$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

new App\Template('Sheetstack keresés: ' . $searchQuery);
include './views/components/artist_item.php';
include './views/components/sheets_item.php';


$artist = new App\Models\Artist;
$uploadedMusic = new App\Models\UploadedMusic;
$categories = new App\Models\Category;


if (!$searchQuery)
    header('Location: ' . $_SERVER['HTTP_REFERER']);

$artistResult = $artist->search($searchQuery, ['name']);

$uploadedMusicResult = $uploadedMusic->search($searchQuery, ['title'],);

if (!$artistResult && !$uploadedMusicResult) {
    echo "<br><p>A <strong>" . $searchQuery . "</strong> kifejezésre nincs találat.</p>";
    echo "<p>Ellenőrizze a helyesírást, vagy rövidítse le a lekérdezést.</p>";
    die();
}
?>

<?php if ($artistResult) : ?>
    <div class="container">
        <h2>"<?= $searchQuery ?>" alkotók</h2>

        <div class="row">
            <?php
            foreach ($artistResult as $artist) {
                artist_item([
                    'img_url' => '/files/artist/' . $artist->img,
                    'name' => $artist->name,
                    'genre' => $categories->getItemById($artist->id)->category,
                    'url' => '/artist/' . $artist->slug
                ]);
            }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($uploadedMusicResult) : ?>
    <div class="container my-5">
        <h2>"<?= $searchQuery ?>" művek</h2>

        <div class="row">
            <?php
            foreach ($uploadedMusicResult as $uploadedMusic) {
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $uploadedMusic->title,
                    'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $uploadedMusic->slug
                ]);
            }
            ?>
        </div>
    </div>
<?php endif; ?>