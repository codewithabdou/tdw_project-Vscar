<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newsController = new NewsController();
    $title = $_POST['Titre'];
    $text = $_POST['Texte'];
    $link = 'link';
    $id = $_POST['ID_News'];



    $newsController->updateNews($id, $title, $text, $link);

} else {
    header('Location: /vscar/admin/news');
}