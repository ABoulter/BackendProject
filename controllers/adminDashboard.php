<?php

require_once("adminAuth.php");
require_once("models/videos.php");


$videosModel = new Videos();
$totalViews = $videosModel->getTotalViews();



require("views/adminDashboard.php");

?>