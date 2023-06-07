<?php
require_once("adminAuth.php");
require_once("models/videos.php");

$videosModel = new Videos();

if (isset($_POST["updateVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }

    $filePathDestination = 'entities/videos/';
    $allowedFilePathTypes = ['video/mp4', 'video/ogg', 'video/webm'];

    $filePathTmpPath = $_FILES["filePath"]["tmp_name"];
    $filePathType = $_FILES["filePath"]["type"];
    $filePath = $_FILES["filePath"]["name"];



    if (empty($filePathTmpPath)) {
        $filePath = $_POST["currentFilePath"];

    } else {
        $filePath = $filePathDestination . $filePath;
        move_uploaded_file($filePathTmpPath, $filePath);
    }

    $videoData = [
        'title' => $_POST["title"],
        'description' => $_POST["description"],
        'filepath' => $filePath,
        'season' => $_POST["season"],
        'episode' => $_POST["episode"],
        'releaseDate' => $_POST["releaseDate"]
    ];

    if ($_FILES["filePath"]["name"] == '') {
        $videosModel->updateVideo($id, $videoData);
        $successMessage = "Video successfully updated";
    }

    if (!in_array($filePathType, $allowedFilePathTypes)) {
        $errorMessage = "Invalid video file type. Only MP4, OGG, and WebM files are allowed.";
    } else {
        $videosModel->updateVideo($id, $videoData);
        $successMessage = "Video successfully updated";
    }




} else if (isset($_POST["deleteVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $videosModel->removeVideo($id);
    $successMessage = "Video successfully deleted";
}

$video = $videosModel->getVideoById($id);
$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/adminEditVideo.php");