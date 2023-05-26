<?php

require_once("models/users.php");
require_once("helpers/RememberFields.php");

if (isset($_POST["submitButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }


    if (
        mb_strlen($_POST["username"]) >= 3 &&
        mb_strlen($_POST["username"]) <= 60 &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 1000
    ) {

        $model = new Users();
        $user = $model->login($_POST["username"]);

        if (
            !empty($user) &&
            password_verify($_POST["password"], $user["password"])
        ) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: home");
            exit();
        } else {
            $message = "Login failed";
        }
    }


}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/login.php");