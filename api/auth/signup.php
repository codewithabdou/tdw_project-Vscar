<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST["username"] ?? null;
    $password = $_POST["password"] ?? null;
    $confirmedPassword = $_POST["confirmedPassword"] ?? null;
    $firstname = $_POST["firstname"] ?? null;
    $lastname = $_POST["lastname"] ?? null;
    $gender = $_POST["gender"] ?? null;
    $birthday = $_POST["birthday"] ?? null;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['signup_form_data'] = $_POST;

    $userController = new UserController();

    $userController->signup($username, $password, $confirmedPassword, $firstname, $lastname, $gender, $birthday);
} else {
    header("Location: /vscar/signup");
}




