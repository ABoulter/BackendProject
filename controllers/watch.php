<?php

require_once("models/entities.php");
require_once("models/videos.php");
require_once("helpers/httpError.php");
require_once("auth.php");


if (empty($id) || !is_numeric($id)) {
    http_response_code(404);
    die(HttpError::showHttpError("../assets/images/404error.png", "Page not Found"));
}



$videosModel = new Videos();
$video = $videosModel->getVideoById($id);

$entitiesModel = new Entities();
$entity = $entitiesModel->getEntityById($video["entityId"]);

if (!$video) {
    http_response_code(404);
    die(HttpError::showHttpError("../assets/images/404error.png", "Page not Found"));
}

$videosModel->incrementViews($id);

$upNextVideo = $videosModel->getUpNext($video);

require("views/watch.php");