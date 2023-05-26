<?php

require_once("models/entities.php");
require_once("models/videos.php");
require_once("helpers/httpError.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: register");
    exit();
}


if (empty($id) || !is_numeric($id)) {
    http_response_code(404);
    die(HttpError::showHttpError("../assets/images/404error.png", "Page not Found"));
}
$entitiesModel = new Entities();
$entity = $entitiesModel->getEntityById($id);

if (!$entity) {
    http_response_code(404);
    die(HttpError::showHttpError("../assets/images/404error.png", "Page not Found"));
}

$videosModel = new Videos();

$seasons = $videosModel->getSeasons($id);



$videos = [];

foreach ($seasons as $seasonNumber) {
    $videos[$seasonNumber] = $videosModel->getVideos($entity['id'], $seasonNumber);
}





require("views/streamPage.php");