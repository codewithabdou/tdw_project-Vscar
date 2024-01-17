<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Ads.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adController = new AdsController();
    $title = $_POST['title'];
    $text = $_POST['text'];
    $link = $_POST['external_link'];
    $id = $_POST['id'];



    $adController->updateAd($id, $title, $text, $link);
} else {
    header('Location: /vscar/admin/settings');
}