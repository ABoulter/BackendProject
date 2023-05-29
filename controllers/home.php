<?php
require_once("models/entities.php");
require_once("models/categories.php");
require_once("models/videoProgress.php");
require_once("models/videos.php");
require_once("auth.php");

$entitiesModel = new Entities();
$categoriesModel = new Categories();
$videoProgressModel = new VideoProgress();
$videoModel = new Videos();

$categories = $categoriesModel->getCategories();

$entities = array();
foreach ($categories as $category) {
    $categoryId = $category['id'];
    $categoryEntities = $entitiesModel->getEntities($categoryId);
    $entities[$categoryId] = $categoryEntities;
}

$userInProgress = $videoProgressModel->isInProgress($userId);

if ($userInProgress) {
    $lastSeenVideo = $videoModel->getLastSeenVideo($userId);
    $videoId = $lastSeenVideo['videoId'];
} else {
    $randomEntity = $entitiesModel->getRandomEntity();
    $videoId = $videoModel->getVideoById($randomEntity["id"]);
}

$video = $videoModel->getVideoById($videoId);
$entity = $entitiesModel->getEntityById($video["entityId"]);

require("views/home.php");
?>