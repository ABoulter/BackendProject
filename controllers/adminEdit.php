<?php
require_once("adminAuth.php");
require_once("models/videos.php");


$videosModel = new Videos();

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$perPage = 25;
$totalVideos = $videosModel->getTotalVideosCount();
$totalPages = ceil($totalVideos / $perPage);

$page = max(1, min($page, $totalPages));

$videos = $videosModel->get($page, $perPage);





require("views/adminEdit.php");

?>