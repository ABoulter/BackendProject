<?php
require_once("auth.php");
require_once("models/videos.php");
require_once("models/entities.php");


if (!$admin) {
    header("Location: login");
    exit();
}


$videosModel = new Videos();
$entitiesModel = new Entities();

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$perPage = 25;
$totalVideos = $videosModel->getTotalVideosCount();
$totalPages = ceil($totalVideos / $perPage);

$page = max(1, min($page, $totalPages));

$videos = $videosModel->getPage($page, $perPage);





require("views/adminEdit.php");

?>