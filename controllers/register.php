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

    function validateData($data)
    {
        $errorArray = array();

        if (strlen($data['firstName']) < 3 || strlen($data['firstName']) > 65) {
            array_push($errorArray, Errors::$firstNameCharacters);
        }

        if (strlen($data['lastName']) < 3 || strlen($data['lastName']) > 65) {
            array_push($errorArray, Errors::$lastNameCharacters);
        }

        if (strlen($data['username']) < 3 || strlen($data['username']) > 65) {
            array_push($errorArray, Errors::$usernameCharacters);
        }

        if ($data['email'] != $data['confirmEmail']) {
            array_push($errorArray, Errors::$emailsDontMatch);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errorArray, Errors::$invalidEmail);
        }

        if (strlen($data['password']) < 6 || strlen($data['password']) > 1000) {
            array_push($errorArray, Errors::$passwordLength);
        }

        if ($data['password'] != $data['confirmPassword']) {
            array_push($errorArray, Errors::$passwordsDontMatch);
        }

        if (!empty($errorArray)) {

            return false;
        }

        return true;
    }

    $validData = validateData($data);

    if ($validData) {
        $users = new Users();
        $success = $users->register($data);

        if ($success) {
            $_SESSION["userLoggedIn"] = $data['username'];
            header("Location: home");
            exit();
        }
    }
}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));

require("views/register.php");