<?php
require_once("models/entities.php");
require_once("auth.php");
$entitiesModel = new Entities();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");
    $requestBody = json_decode(file_get_contents("php://input"), true);
    $searchInput = $requestBody["input"];

    $results = $entitiesModel->searchEntities($searchInput);



    echo json_encode($results);

} else {
    require("views/search.php");
}


?>