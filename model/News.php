<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/utils/images.php");

class NewsModel
{

    public function getAllNews()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM news");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function toggleNews($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM news WHERE ID_News = :id");
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result['ShowInHome'] == 1) {
                $stmt = $conn->prepare("UPDATE news SET ShowInHome = 0 WHERE ID_News = :id");
            } else {
                $stmt = $conn->prepare("UPDATE news SET ShowInHome = 1 WHERE ID_News = :id");
            }
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function addNews($title, $text, $link)
    {
        if (!isset($_FILES['Image']) || $_FILES['Image']['error'] == UPLOAD_ERR_NO_FILE) {
            throw new ErrorException("No file uploaded");
        }
        $dbController = new DataBaseController();
        $imagesTraitement = new ImagesTraitement();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO news (Titre,Texte,Image,Lien) VALUES (:title,:text,:image,:link)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':image', $_FILES['Image']['name']);
        $stmt->bindParam(':link', $link);

        try {
            $stmt->execute();
            try {
                $imagesTraitement->uploadImage('Image', '/public/images/news/');
            } catch (\Throwable $th) {
                $this->deleteNews($conn->lastInsertId());
                throw new ErrorException($th->getMessage());
            }
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($th->getMessage());
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function deleteNews($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM news WHERE ID_News = :id");
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function getNewsToShowInHome()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM news WHERE ShowInHome = 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getNewsByID($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM news WHERE ID_News = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function updateNews($id, $title, $text, $link)
    {
        if (isset($_FILES['Image']) && $_FILES['Image']['error'] == UPLOAD_ERR_OK) {
            $dbController = new DataBaseController();
            $imagesTraitement = new ImagesTraitement();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("UPDATE news SET Titre = :title, Texte = :text, lien = :link ,Image = :image WHERE ID_News = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':image', $_FILES['Image']['name']);

            try {
                $stmt->execute();
                try {
                    $imagesTraitement->uploadImage('Image', '/public/images/news/');
                } catch (\Throwable $th) {
                    throw new ErrorException($th->getMessage());
                }
                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            } finally {
                $dbController->disconnect($conn);
            }
        } else {
            $dbController = new DataBaseController();
            $imagesTraitement = new ImagesTraitement();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("UPDATE news SET Titre = :title, Texte = :text, lien = :link  WHERE ID_News = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':link', $link);

            try {
                $stmt->execute();

                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            } finally {
                $dbController->disconnect($conn);
            }

        }
    }

}