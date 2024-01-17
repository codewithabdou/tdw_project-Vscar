<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Ads.php';

if (isset($_POST['id'])) {
    $adController = new AdsController();
    echo $_POST['id'];
    $adController->deleteAd($_POST['id']);
} else {
    header('Location: /vscar/admin/settings');
}