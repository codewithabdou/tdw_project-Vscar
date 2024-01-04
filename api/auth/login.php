<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");




$username = $_POST["username"] ?? null;
$password = $_POST["password"] ?? null;
if (session_status() == PHP_SESSION_NONE) {
    // Start the session if it's not already started
    session_start();
}$_SESSION['login_form_data'] = $_POST;
$userController = new UserController();

$userController->login($username, $password);



