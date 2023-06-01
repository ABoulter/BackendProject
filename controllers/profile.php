<?php

require_once("models/users.php");
require_once("auth.php");




$model = new Users();
$user = $model->getUser($userId);



if (isset($_POST["saveDetailsButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {

    $updatedData = array_map('trim', $_POST);
    $updatedData = array_map('htmlspecialchars', $updatedData);
    $updatedData = array_map('strip_tags', $updatedData);

    if (
        isset($updatedData["firstName"]) &&
        isset($updatedData["lastName"]) &&
        isset($updatedData["email"]) &&
        mb_strlen($updatedData["firstName"]) >= 3 &&
        mb_strlen($updatedData["firstName"]) <= 60 &&
        mb_strlen($updatedData["lastName"]) >= 3 &&
        mb_strlen($updatedData["lastName"]) <= 60 &&
        filter_var($updatedData["email"], FILTER_VALIDATE_EMAIL)
    ) {

        $updatedUser = array(
            "firstName" => $updatedData["firstName"],
            "lastName" => $updatedData["lastName"],
            "email" => $updatedData["email"]
        );

        if ($model->updateUserDetails($userId, $updatedUser)) {

            $detailsMessage = "Details Updated successfully!";

        } else {

            $errorMessage = "Failed to update your details!";
        }
    }
}
if (isset($_POST["savePasswordButton"]) && $_SESSION["csrf_token"] === $_POST["csrf_token"]) {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $newPassword2 = $_POST["newPassword2"];

    if (strlen($newPassword) >= 8 && strlen($newPassword) <= 1000) {

        if ($newPassword === $newPassword2) {

            if (password_verify($oldPassword, $user["password"])) {

                if ($model->updatePassword($userId, $newPassword)) {
                    $passwordMessage = "Password updated successfully!";
                } else {
                    $passwordError = "Failed to update the password.";
                }
            } else {
                $passwordError = "Your old password is incorrect.";
            }
        } else {
            $passwordError = "New passwords do not match.";
        }
    } else {
        $passwordError = "Password must be between 8 and 1000 characters.";
    }
}

$_SESSION["csrf_token"] = bin2hex(random_bytes(16));







require("views/profile.php");