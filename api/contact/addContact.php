<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Contact.php");

if (isset($_POST['sender']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $contactController = new ContactController();
    $contactController->addContact($_POST['sender'], $_POST['email'], $_POST['subject'], $_POST['message']);
} else {
    header("Location: /vscar/contact");
}