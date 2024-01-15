<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php';

if (isset($_POST['id'])) {
    $newsController = new NewsController();
    echo $_POST['id'];
    $newsController->deleteNews($_POST['id']);
} else {
    header('Location: /vscar/admin/news');
}