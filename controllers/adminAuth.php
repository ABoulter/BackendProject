<?php


if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

$userId = $_SESSION["user_id"];
$username = $_SESSION["username"];
$admin = $_SESSION["admin"];

if (!$admin) {
    header("Location: login");
    exit();
}