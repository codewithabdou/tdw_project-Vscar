<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"] ?? null;
    $password = $_POST["password"] ?? null;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }$_SESSION['login_form_data'] = $_POST;
    $userController = new UserController();
    
    $userController->login($username, $password);
}else{
    header("Location: /vscar/login");
}





