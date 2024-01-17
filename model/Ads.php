<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/utils/images.php");

class AdsModel
{
    public function addnewAd($title, $text, $link)
    {
        if (!isset($_FILES['ImageAd']) || $_FILES['ImageAd']['error'] == UPLOAD_ERR_NO_FILE) {
            throw new ErrorException("No file uploaded");
        }
        if (empty($title) || empty($text) || empty($link)) {
            throw new ErrorException("Please fill all the fields");
        }
        $dbController = new DataBaseController();
        $imagesTraitement = new ImagesTraitement();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO ads (title,text,image,external_link) VALUES (:title,:text,:image,:link)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':image', $_FILES['ImageAd']['name']);
        $stmt->bindParam(':link', $link);
        try {
            $stmt->execute();
            try {
                $imagesTraitement->uploadImage('ImageAd', '/public/images/ads/');
                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            }
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }

    }

    public function deleteAd($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM ads WHERE id = :id");
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

    public function updateAd($id, $title, $text, $link)
    {
        if (empty($title) || empty($text) || empty($link)) {
            throw new ErrorException("Please fill all the fields");
        }

        if (!isset($_FILES['ImageAd']) || $_FILES['ImageAd']['error'] == UPLOAD_ERR_NO_FILE) {
            $dbController = new DataBaseController();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("UPDATE ads SET title = :title, text = :text, external_link = :link WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':id', $id);
            try {
                $stmt->execute();
                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($stmt->queryString);
            } finally {
                $dbController->disconnect($conn);
            }

        } else {
            $dbController = new DataBaseController();
            $imagesTraitement = new ImagesTraitement();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("UPDATE ads SET title = :title, text = :text, image = :image, external_link = :link WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':image', $_FILES['ImageAd']['name']);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':id', $id);
            try {
                $stmt->execute();
                try {
                    $imagesTraitement->uploadImage('ImageAd', '/public/images/ads/');
                    return true;
                } catch (\Throwable $th) {
                    throw new ErrorException($th->getMessage());
                }
            } catch (\Throwable $th) {
                throw new ErrorException($stmt->queryString);
            } finally {
                $dbController->disconnect($conn);
            }

        }
    }


    public function getAllAds()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM ads");
        try {
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function getAd($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM ads WHERE id = :id");
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function toggleShowAd($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM ads WHERE id = :id");
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result['show_in_home'] == 1) {
                $stmt = $conn->prepare("UPDATE ads SET show_in_home = 0 WHERE id = :id");
            } else {
                $stmt = $conn->prepare("UPDATE ads SET show_in_home = 1 WHERE id = :id");
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

    public function getAdsToShowInHome(){
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM ads WHERE show_in_home = 1");
        try {
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }
}