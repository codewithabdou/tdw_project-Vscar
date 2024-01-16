<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/Vehicule.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: /vscar/admin/vehicules");
    exit;
} else {
    $vehiculeController = new VehiculeController();
    $vehiculeController->deleteVehicule($_POST['id']);
}






