<?php
require_once("adminAuth.php");
require_once("models/videos.php");

$videosModel = new Videos();

if (isset($_POST["updateVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $videoData = [
        'title' => $_POST["title"],
        'description' => $_POST["description"],
        'filepath' => $_POST["filepath"],
        'season' => $_POST["season"],
        'episode' => $_POST["episode"],
        'releaseDate' => $_POST["releaseDate"]
    ];

    $videosModel->updateVideo($id, $videoData);
    $successMessage = "Video successfully updated";

}

$video = $videosModel->getVideoById($id);
$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/adminEditVideo.php");