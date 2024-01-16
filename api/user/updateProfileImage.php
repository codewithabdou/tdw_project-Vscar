<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");


if (isset($_COOKIE['loggedIn']) && $_COOKIE['loggedIn'] === 'true' && isset($_COOKIE['userId'])) {
    $userController = new UserController();
    $userController->updateUserProfileImage($_COOKIE['userId']);
    exit;
} else {
    header("Location: /vscar");
    exit;
}