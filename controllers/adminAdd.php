<?php
require_once("auth.php");
require_once("models/videos.php");
require_once("models/entities.php");
require_once("models/categories.php");

if (!$admin) {
    header("Location: login");
    exit();
}

$videosModel = new Videos();
$entitiesModel = new Entities();
$categoriesModel = new Categories();

if (isset($_POST["createVideo"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }

    $filePathDestination = 'entities/videos/';
    $allowedFilePathTypes = ['video/mp4', 'video/ogg', 'video/webm'];

    $title = $_POST["title"];
    $description = $_POST["description"];
    $filePathTmpPath = $_FILES["filePath"]["tmp_name"];
    $filePathType = $_FILES["filePath"]["type"];
    $filePath = $_FILES["filePath"]["name"];
    move_uploaded_file($filePathTmpPath, $filePath);
    $isMovie = $_POST["isMovie"];
    $releaseDateInput = $_POST["releaseDate"];
    $releaseDate = date("Y-m-d", strtotime($releaseDateInput));
    $season = $_POST["season"];
    $episode = $_POST["episode"];
    $entityId = $_POST["entitySelect"];



    $videoData = [
        'title' => $title,
        'description' => $description,
        'filePath' => $filePathDestination . $filePath,
        'isMovie' => $isMovie,
        'uploadDate' => date("Y-m-d H:i:s"),
        'releaseDate' => $releaseDate,
        'views' => 0,
        'duration' => '47:00',
        'season' => $season,
        'episode' => $episode,
        'entityId' => $entityId,
    ];



    if (!in_array($filePathType, $allowedFilePathTypes)) {
        $errorMessage = "Invalid video file type. Only MP4, OGG, and WebM files are allowed.";
    } else {
        $createdVideo = $videosModel->createVideo($videoData);
    }

    if ($createdVideo) {
        $successMessage = "Video successfully created";
    } else {
        $errorMessage = "Error: Video creation failed. Please check the season, episode, or entity information.";
    }




}

if (isset($_POST["createEntity"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }

    $allowedThumbnailTypes = ['image/jpeg', 'image/png'];
    $allowedPreviewTypes = ['video/mp4', 'video/ogg', 'video/webm'];
    $thumbnailDestination = 'entities/thumbnails/';
    $previewDestination = 'entities/previews/';



    $entityName = $_POST["entityName"];

    $thumbnailTmpPath = $_FILES["thumbnail"]["tmp_name"];
    $thumbnailType = $_FILES["thumbnail"]["type"];
    $thumbnail = $_FILES["thumbnail"]["name"];
    move_uploaded_file($thumbnailTmpPath, $thumbnailDestination . $thumbnail);

    $previewTmpPath = $_FILES["preview"]["tmp_name"];
    $previewType = $_FILES["preview"]["type"];
    $preview = $_FILES["preview"]["name"];
    move_uploaded_file($previewTmpPath, $previewDestination . $preview);

    $categoryId = $_POST["categorySelect"];


    $entityData = [
        'name' => $entityName,
        'thumbnail' => $thumbnailDestination . $thumbnail,
        'preview' => $previewDestination . $preview,
        'categoryId' => $categoryId
    ];


    if (!in_array($thumbnailType, $allowedThumbnailTypes)) {
        $errorMessage = "Invalid thumbnail file type. Only JPEG and PNG files are allowed.";
    } else if (!in_array($previewType, $allowedPreviewTypes)) {
        $errorMessage = "Invalid preview file type. Only MP4, OGG, and WebM files are allowed.";
    } else {
        $createdEntity = $entity = $entitiesModel->createEntity($entityData);
    }

    if ($createdEntity) {
        $successMessage = "Entity successfully created";
    } else {
        $errorMessage = "Error: Entity already exists.";
    }
}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));


$entities = $entitiesModel->getAllEntities();
$categories = $categoriesModel->getCategories();


require("views/adminAdd.php");