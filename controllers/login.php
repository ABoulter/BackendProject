<?php

require_once("models/users.php");
require_once("helpers/Errors.php");
require_once("helpers/RememberFields.php");

if (isset($_POST["submitButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }


    $credentials = [
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ];

    require_once("models/Users.php");
    $users = new Users();
    $success = $users->login($credentials);

    if ($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: home");
        exit();
    } else {
        $loginFailedError = Errors::$loginFailed;
    }
}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/login.php");