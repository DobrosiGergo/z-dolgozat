<?php

require_once __DIR__ . '/../lib/autoload.php';

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

$artistNamespace = new App\Models\Artist;

$fetchData = json_decode(file_get_contents('php://input'), true) ?? null;


if ($fetchData) {
    $addSheetToRecents = App\Controllers\SheetController::addSheetToRecents($fetchData["sheet_id"], $user->id);

    $response = ["success" => $addSheetToRecents];

    echo json_encode($response);
};
