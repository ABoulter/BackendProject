<?php


if (!isset($_SESSION["user_id"]) && !$_SESSION["admin"] == 1) {
    header("Location: login");
    exit();
}

$userId = $_SESSION["user_id"];
$username = $_SESSION["username"];
$admin = $_SESSION["admin"];