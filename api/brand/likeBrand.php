<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/Marque.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['userId'])) {
    $marqueController = new MarqueController();
    $brandId = $_POST['id'] ?? null;
    $userId = $_COOKIE['userId'];
    $marqueController->likeBrandByUser($userId, $brandId);
}





