<?php
require_once("models/entities.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: register");
    exit();
}



$model = new Entities();

$homeContent = $model->getHomePageContent();

$previewVideo = $model->createPreviewVideo($homeContent["videoEntity"]);

require_once("views/home.php");