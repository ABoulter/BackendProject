<?php
require_once("auth.php");
require_once("models/videos.php");


if (!$admin) {
    header("Location: login");
    exit();
}

$videosModel = new Videos();
$totalViews = $videosModel->getTotalViews();



require("views/adminDashboard.php");

?>