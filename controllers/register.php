<?php
require_once("models/users.php");
require_once("helpers/Errors.php");
require_once("helpers/RememberFields.php");



if (isset($_POST["submitButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }

    $data = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'confirmEmail' => $_POST['email2'],
        'password' => $_POST['password'],
        'confirmPassword' => $_POST['password2']
    ];

    $validData = (
        mb_strlen($data['firstName']) >= 3 &&
        mb_strlen($data['firstName']) <= 65 &&
        mb_strlen($data['lastName']) >= 3 &&
        mb_strlen($data['lastName']) <= 65 &&
        mb_strlen($data['username']) >= 3 &&
        mb_strlen($data['username']) <= 65 &&
        filter_var($data['email'], FILTER_VALIDATE_EMAIL) &&
        $data['email'] === $data['confirmEmail'] &&
        mb_strlen($data['password']) >= 6 &&
        mb_strlen($data['password']) <= 1000 &&
        $data['password'] === $data['confirmPassword']);


    if ($validData) {

        $users = new Users();
        $success = $users->register(
            $data
        );

        if ($success) {
            $_SESSION["userLoggedIn"] = $data['username'];
            header("Location: home");
            exit();
        }
    }
}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/register.php");