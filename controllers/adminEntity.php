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

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$perPage = 25;
$totalEntities = $entitiesModel->getTotalEntitiesCount();
$totalPages = ceil($totalEntities / $perPage);

$page = max(1, min($page, $totalPages));

$entities = $entitiesModel->getPage($page, $perPage);




require("views/adminEntity.php");

?>