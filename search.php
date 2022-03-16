<?php
require_once __DIR__ . '/lib/autoload.php';

$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

new App\Template('Sheetstack keresés: ' . $searchQuery);
include './views/components/artist_item.php';
include './views/components/sheets_item.php';


$artist = new App\Models\Artist;
$uploadedMusic = new App\Models\UploadedMusic;
$categories = new App\Models\Category;
$instruments = new App\Models\Instruments;


if (!$searchQuery)
    header('Location: ' . $_SERVER['HTTP_REFERER']);

$artistResult = $artist->search($searchQuery, ['name']);

$uploadedMusicResult = $uploadedMusic->search($searchQuery, ['title'],);

if (!$artistResult && !$uploadedMusicResult) {
    echo "<br><p>A <strong>" . $searchQuery . "</strong> kifejezésre nincs találat.</p>";
    echo "<p>Ellenőrizze a helyesírást, vagy rövidítse le a lekérdezést.</p>";
    die();
}


$genre_filter = isset($_GET['genre']) ? $_GET['genre'] : 0;
$instrument_filter = isset($_GET['instrument']) ? $_GET['instrument'] : 0;

$filter = $genre_filter || $instrument_filter;
$filters = [];
if ($filter) {


    if ($genre_filter)
        $filters["genre_id"] = $genre_filter;

    if ($instrument_filter)
        $filters["instrument_id"] = $instrument_filter;

    $uploadedMusic = $uploadedMusic->filter($filters);
} else {
    $uploadedMusic = $uploadedMusic->all();
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
        <div class="row my-4">
            <?php
            foreach ($uploadedMusicResult as $uploadedMusic) {
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => $uploadedMusic->title,
                    'author_name'   => $artist->getItemBy('id', $uploadedMusic->artist_id)->name,
                    'author_url'    => '/artist/' . $artist->getItemBy('id', $uploadedMusic->artist_id)->slug,
                    'genre'         => $categories->getItemBy('id', $uploadedMusic->genre_id)->category,
                    'page_number'   => 4,
                    'url'           => '/music/' . $uploadedMusic->slug,
                    'user_id'       => $user->id
                ]);
            }
            ?>
        </div>
    </div>
<?php endif; ?>