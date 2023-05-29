<?php

require_once("models/entities.php");
require_once("models/categories.php");
require_once("models/videoProgress.php");
require_once("models/videos.php");
require_once("auth.php");


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

$videoProgressModel = new VideoProgress();
$lastSeenVideo = $videosModel->getLastSeenVideo($userId);
$firstEpisodeId = $videosModel->getFirstEpisodeId($entity["id"]);
$lastSeenVideoId = $lastSeenVideo['videoId'];
$lastSeenVideoData = $videosModel->getVideoById($lastSeenVideoId);




require("views/streamPage.php");