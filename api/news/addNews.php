<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newsController = new NewsController();
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == UPLOAD_ERR_OK) {
        $title = $_POST['Titre'];
        $text = $_POST['Texte'];
        $link = 'link';

        $imageFileName = $_FILES['Image']['name'];
        $imageTempName = $_FILES['Image']['tmp_name'];

        echo $imageFileName;
        echo $imageTempName;

        $newsController->addNews($title, $text, $link);
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['addNews_error'] = "No file uploaded";
        header('Location: /vscar/admin/news');
    }
} else {
    header('Location: /vscar/admin/news');
}