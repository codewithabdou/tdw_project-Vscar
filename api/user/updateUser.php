<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST["userId"] ?? null;
    $from = $_POST["from"] ?? null;
    $firstname = $_POST["Nom"] ?? null;
    $lastname = $_POST["Prénom"] ?? null;
    $gender = $_POST["Sexe"] ?? null;
    $birthday = $_POST["Date_de_naissance"] ?? null;
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['updateUser_form_data'] = $_POST;
    
    $userController = new UserController();
    
    $userController->updateUser($userId, $firstname, $lastname, $gender, $birthday,$from);
}else{
    header("Location: /vscar/login");
}





