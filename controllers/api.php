<?php


header("Content-Type: application/json");

$allowed_options = ["progress"];

if (isset($url_parts[2])) {
    $option = $url_parts[2];
}

if (!empty($url_parts[3])) {
    $id = $url_parts[3];
}

if (empty($option)) {
    http_response_code(400);
    die('{"message":"Bad Request"}');
} else if (!in_array($option, $allowed_options)) {
    http_response_code(404);
    die('{"message":"Not Found"}');
}

require("models/" . $option . ".php");

$className = ucwords($option);

$model = new $className();



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $response = "This is a GET request.";
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($option === "progress") {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        http_response_code(202);
        $model->addVideoProgress($data);
        $response = "Video progress added successfully.";
    } else {
        http_response_code(404);
        $response = "Invalid option";
    }
} else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    if ($option === "progress") {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        $model->updateVideoProgress($data);
        http_response_code(202);
        $response = "Video progress updated successfully.";
    }
} else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $response = "This is a DELETE request.";
}

if (empty($response)) {
    var_dump($response);
    http_response_code(404);
    $response = "not Not Found";
}

echo json_encode($response);