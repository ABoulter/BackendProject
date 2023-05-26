<?php

require_once("models/entities.php");
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


require("views/streamPage.php");