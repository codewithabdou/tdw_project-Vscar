<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");

if (isset($_COOKIE['userId'])) {
    $userController = new UserController();
    $userController->logout();
} else {
    header("Location: /vscar/login");
}



