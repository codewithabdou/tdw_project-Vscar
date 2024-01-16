<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newsController = new NewsController();
    // Access the post details
    $title = $_POST['Titre'];
    $text = $_POST['Texte'];
    $link = $_POST['lien'];
    $id = $_POST['ID_News'];



    // Proceed with the file handling and news addition
    $newsController->updateNews($id, $title, $text, $link);

} else {
    header('Location: /vscar/admin/news');
}