<?php
require_once("adminAuth.php");
require_once("models/entities.php");
require_once("models/categories.php");

$entitiesModel = new Entities();
$categoriesModel = new Categories();

if (isset($_POST["updateEntity"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }


    $thumbnailDestination = 'entities/thumbnails/';
    $previewDestination = 'entities/previews/';


    $entityName = $_POST["entityName"];
    $thumbnailTmpPath = $_FILES["thumbnail"]["tmp_name"];
    $thumbnail = $_FILES["thumbnail"]["name"];
    move_uploaded_file($thumbnailTmpPath, $thumbnailDestination . $thumbnail);
    $previewTmpPath = $_FILES["preview"]["tmp_name"];
    $preview = $_FILES["preview"]["name"];
    move_uploaded_file($previewTmpPath, $previewDestination . $preview);
    $categoryId = $_POST["categorySelect"];


    $entityData = [
        'name' => $entityName,
        'thumbnail' => $thumbnailDestination . $thumbnail,
        'preview' => $previewDestination . $preview,
        'categoryId' => $categoryId
    ];

    $entitiesModel->updateEntity($id, $entityData);
    $successMessage = "Entity successfully updated";

} else if (isset($_POST["deleteEntity"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $entitiesModel->removeEntity($id);
    $successMessage = "Entity successfully deleted";
}


$categories = $categoriesModel->getCategories();
$entity = $entitiesModel->getEntityById($id);

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/adminEditEntity.php");






$createdEntity = $entity = $entitiesModel->createEntity($entityData);

if ($createdEntity) {
    $successMessage = "Entity successfully created";
} else {
    $errorMessage = "Error: Entity already exists.";
}