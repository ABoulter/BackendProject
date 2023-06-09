<?php
require_once("auth.php");
require_once("models/entities.php");
require_once("models/categories.php");


if (!$admin) {
    header("Location: login");
    exit();
}

$entitiesModel = new Entities();
$categoriesModel = new Categories();

if (isset($_POST["updateEntity"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
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

    $previewTmpPath = $_FILES["preview"]["tmp_name"];
    $previewType = $_FILES["preview"]["type"];
    $preview = $_FILES["preview"]["name"];

    $categoryId = $_POST["categorySelect"];

    if (empty($thumbnailTmpPath)) {
        $thumbnail = $_POST["currentThumbnail"];

    } else {
        $thumbnail = $thumbnailDestination . $thumbnail;
        move_uploaded_file($thumbnailTmpPath, $thumbnail);
    }
    if (empty($previewTmpPath)) {
        $preview = $_POST["currentPreview"];

    } else {
        $preview = $previewDestination . $preview;
        move_uploaded_file($previewTmpPath, $preview);
    }

    $entityData = [
        'name' => $entityName,
        'thumbnail' => $thumbnail,
        'preview' => $preview,
        'categoryId' => $categoryId,

    ];


    if ($_FILES["thumbnail"]["name"] == '' || $_FILES["preview"]["name"] == '') {

        $entitiesModel->updateEntity($id, $entityData);
        $successMessage = "Entity successfully updated";
    }
    if (!in_array($thumbnailType, $allowedThumbnailTypes)) {
        $errorMessage = "Invalid thumbnail file type. Only JPEG and PNG files are allowed.";
    } else if (!in_array($previewType, $allowedPreviewTypes)) {
        $errorMessage = "Invalid preview file type. Only MP4, OGG, and WebM files are allowed.";
    } else {
        $entitiesModel->updateEntity($id, $entityData);
        $successMessage = "Entity successfully updated";
    }



} else if (isset($_POST["deleteEntity"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $entitiesModel->removeEntity($id);
    $successMessage = "Entity successfully deleted";
}


$categories = $categoriesModel->getCategories();
$entity = $entitiesModel->getEntityById($id);

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));


require("views/adminEditEntity.php");