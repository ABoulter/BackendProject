<?php

require_once("adminAuth.php");



$allowed_options = ["videos"];

if (isset($url_parts[2])) {
    $option = $url_parts[2];
}

if (!empty($url_parts[3])) {
    $id = $url_parts[3];
}


if (empty($option)) {


    require_once("models/videos.php");
    $videosModel = new Videos();
    $totalViews = $videosModel->getTotalViews();


    require("views/adminDashboard.php");


} else if (!empty($id)) {
    require("models/" . $option . ".php");
    $className = ucwords($option);
    $model = new $className;

    if (isset($_POST["send"])) {
        $model->update($_POST);

    }


    require("views/adminEdit" . $option . ".php");
} else {
    require("models/" . $option . ".php");
    $className = ucwords($option);
    $model = new $className;


    if (isset($_POST["send"])) {
        $data = $model->create($_POST);
        header("Location: /adminAdd" . $option . "/" . $data["id"]);

    }

    $data = $model->get();

    require("views/adminAdd" . $option . ".php");
}







?>