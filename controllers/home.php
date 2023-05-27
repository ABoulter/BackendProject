<?php
require_once("models/entities.php");
require_once("models/categories.php");
require_once("auth.php");


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

require("views/home.php");
?>