<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Contact.php");

if (isset($_POST['id'])) {
    $contactController = new ContactController();
    $contactController->deleteContact($_POST['id']);
}
header("Location: /vscar/admin/settings");
