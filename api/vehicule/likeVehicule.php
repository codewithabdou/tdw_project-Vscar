<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/Vehicule.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['userId'])) {
    $vehiculeController = new VehiculeController();
    $vehiculeId = $_POST['id'] ?? null;
    $userId = $_COOKIE['userId'];
    $vehiculeController->likeVehiculeByUser($userId, $vehiculeId);
}





