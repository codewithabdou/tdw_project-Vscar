<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/Marque.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: /vscar/admin/vehicules");
    exit;
} else {
    $marqueController = new MarqueController();
    $marqueController->deleteMarque($_POST['id']);
}






