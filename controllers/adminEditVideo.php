<?php
require_once("adminAuth.php");
require_once("models/videos.php");

$videosModel = new Videos();

if (isset($_POST["updateVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $filePathDestination = 'entities/videos/';
    $filePathTmpPath = $_FILES["filePath"]["tmp_name"];
    $filePath = $_FILES["filePath"]["name"];
    move_uploaded_file($filePathTmpPath, $filePathDestination . $filePath);

    $videoData = [
        'title' => $_POST["title"],
        'description' => $_POST["description"],
        'filepath' => $filePathDestination . $filePath,
        'season' => $_POST["season"],
        'episode' => $_POST["episode"],
        'releaseDate' => $_POST["releaseDate"]
    ];

    $videosModel->updateVideo($id, $videoData);
    $successMessage = "Video successfully updated";

} else if (isset($_POST["deleteVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $videosModel->removeVideo($id);
    $successMessage = "Video successfully deleted";
}

$video = $videosModel->getVideoById($id);
$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/adminEditVideo.php");