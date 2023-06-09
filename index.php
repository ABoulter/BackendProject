<?php
session_start();

$url_parts = explode("/", $_SERVER["REQUEST_URI"]);

define("ENV", parse_ini_file(".env"));

$controller = "home";

$allowed_controllers = [
    "login",
    "register",
    "home",
    "streamPage",
    "watch",
    "api",
    "movies",
    "tvShows",
    "search",
    "profile",
    "logout",
    "billing",
    "adminDashboard",
    "adminEdit",
    "adminEditVideo",
    "adminAdd",
    "adminEntity",
    "adminEditEntity",
    "subscribe"
];

if (!empty($url_parts[1])) {
    $controllerParts = explode("?", $url_parts[1]);
    $controller = $controllerParts[0];
}



if (!empty($url_parts[2])) {
    $id = $url_parts[2];
}


if (!in_array($controller, $allowed_controllers)) {
    http_response_code(404);
    die(HttpError::showHttpError("assets/images/404error.png", "Page not Found"));
}

require("controllers/" . $controller . ".php");