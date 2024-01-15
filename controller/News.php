<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/News.php');

class NewsController
{
    public function getAllNews()
    {
        $newsModel = new NewsModel();
        return $newsModel->getAllNews();
    }

    public function addNews($title, $text, $link)
    {
        $newsModel = new NewsModel();
        try {
            $newsModel->addNews($title, $text, $link);
            header('Location: /vscar/admin/news');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['addNews_error'] = $th->getMessage();
            header('Location: /vscar/admin/news');
        }
    }

    public function deleteNews($id)
    {
        $newsModel = new NewsModel();
        try {
            $newsModel->deleteNews($id);
            header('Location: /vscar/admin/news');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['deleteNews_error'] = $th->getMessage();
            header('Location: /vscar/admin/news');
        }
        return $newsModel->deleteNews($id);
    }

    public function getNewsToShowInHome()
    {
        $newsModel = new NewsModel();
        return $newsModel->getNewsToShowInHome();
    }

    public function getNewsByID($id)
    {
        $newsModel = new NewsModel();
        return $newsModel->getNewsByID($id);
    }

    public function updateNews($id, $title, $text, $link)
    {
        $newsModel = new NewsModel();
        try {
            $newsModel->updateNews($id, $title, $text, $link);
            header('Location: /vscar/admin/news');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateNews_error'] = $th->getMessage();
            header('Location: /vscar/admin/news');
        }
    }
}