<?php

require_once("models/users.php");
require_once("helpers/RememberFields.php");

if (isset($_POST["submitButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }
    if (
        mb_strlen($_POST["firstName"]) >= 3 &&
        mb_strlen($_POST["firstName"]) <= 60 &&
        mb_strlen($_POST["lastName"]) >= 3 &&
        mb_strlen($_POST["lastName"]) <= 60 &&
        mb_strlen($_POST["username"]) >= 3 &&
        mb_strlen($_POST["username"]) <= 60 &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        $_POST["email"] === $_POST["email2"] &&
        $_POST["password"] === $_POST["password2"] &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 1000
    ) {
        $message = "Account has been created";

        require_once("models/users.php");
        $modelUsers = new Users();

        $user_id = $modelUsers->register($_POST);

        if ($user_id !== false) {
            $_SESSION["user_id"] = $user_id;
            header("Location: home");
            exit();
        } else {
            $message = "Account already exists";
        }
    } else {
        $message = "Required information not filled in correctly";
    }
}
$_SESSION["csrf_token"] = bin2hex(random_bytes(16));
require("views/register.php");