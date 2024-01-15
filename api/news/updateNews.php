<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newsController = new NewsController();
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == UPLOAD_ERR_OK) {
        // Access the post details
        $title = $_POST['Titre'];
        $text = $_POST['Texte'];
        $link = $_POST['lien'];
        $id = $_POST['ID_News'];

        //print all $post
        print_r($_POST);

        // Access the file details
        $imageFileName = $_FILES['Image']['name'];
        $imageTempName = $_FILES['Image']['tmp_name'];

        echo $imageFileName;
        echo $imageTempName;

        // Proceed with the file handling and news addition
        $newsController->updateNews($id, $title, $text, $link);
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['updateNews_error'] = "No file uploaded";
        header('Location: /vscar/admin/news?newsId=' . $id);
    }
} else {
    header('Location: /vscar/admin/news');
}