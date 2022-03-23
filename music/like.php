<?php

require_once __DIR__ . '/../lib/autoload.php';

$instruments = new App\Models\Instruments;
$categories = new App\Models\Category;

$artistNamespace = new App\Models\Artist;

$fetchData = json_decode(file_get_contents('php://input'), true) ?? null;


if ($fetchData && $fetchData["action"] == "like") {
    if ($user->like($fetchData["sheet_id"]))
        echo json_encode(["success" => true]);
}

if ($fetchData && $fetchData["action"] == "unlike") {
    $like = $user->isLiked($fetchData["sheet_id"]);
    if ($user->unlike($like))
        echo json_encode(["success" => true]);
}
