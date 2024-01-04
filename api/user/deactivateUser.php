<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");

$userID = $_POST['id'] ?? null;

if (!$userID) {
    header("Location: /vscar/admin/users");
    exit;
}

$userController = new UserController();

$userController->deactivateUser($userID);


