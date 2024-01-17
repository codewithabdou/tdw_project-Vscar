<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Ads.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adController = new AdsController();
    if (isset($_FILES['ImageAd']) && $_FILES['ImageAd']['error'] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $link = $_POST['external_link'];

        $imageFileName = $_FILES['ImageAd']['name'];
        $imageTempName = $_FILES['ImageAd']['tmp_name'];

        echo $imageFileName;
        echo $imageTempName;

        $adController->addnewAd($title, $text, $link);
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['addNews_error'] = "No file uploaded";
        header('Location: /vscar/admin/settings');
    }
} else {
    header('Location: /vscar/admin/settings');
}