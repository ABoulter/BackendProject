<?php
require_once("models/entities.php");
require_once("models/categories.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: register");
    exit();
}

$entitiesModel = new Entities();
$categoriesModel = new Categories();

$categories = $categoriesModel->getCategories();

$entities = array();
foreach ($categories as $category) {
    $categoryId = $category['id'];
    $categoryEntities = $entitiesModel->getEntities($categoryId);
    $entities[$categoryId] = $categoryEntities;
}

$randomEntity = $entitiesModel->getRandomEntity();

require_once("views/home.php");
?>