<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/ContactInfos.php");

if (isset($_POST['adresse']) && isset($_POST['email']) && isset($_POST['numéro'])) {
    $contactInfosController = new ContactInfosController();
    $contactInfosController->updateContactInfos($_POST['adresse'], $_POST['email'], $_POST['numéro']);
} else {
    header("Location: /vscar/admin/settings");
}