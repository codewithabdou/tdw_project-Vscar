<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/DataBase.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/utils/images.php");

class PurchaseGuideModel
{
    public function getPurchaseGuide()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM guide_achat");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function updatePurchaseGuide($guideAchat)
    {

        if (empty($guideAchat['title']) || empty($guideAchat['stepTitle1']) || empty($guideAchat['stepParagraph1']) || empty($guideAchat['stepTitle2']) || empty($guideAchat['stepParagraph2']) || empty($guideAchat['stepTitle3']) || empty($guideAchat['stepParagraph3']) || empty($guideAchat['stepTitle4']) || empty($guideAchat['stepParagraph4']) || empty($guideAchat['stepTitle5']) || empty($guideAchat['stepParagraph5']) || empty($guideAchat['stepTitle6']) || empty($guideAchat['stepParagraph6']) || empty($guideAchat['stepTitle7']) || empty($guideAchat['stepParagraph7']) || empty($guideAchat['stepTitle8']) || empty($guideAchat['stepParagraph8'])) {
            throw new ErrorException("All fields are required");
        }
        if (!isset($_FILES['ImagePurchase']) || $_FILES['ImagePurchase']['error'] == UPLOAD_ERR_NO_FILE) {
            $dbController = new DataBaseController();
            $conn = $dbController->connect();

            $stmt = $conn->prepare("UPDATE guide_achat SET 
                title = :title,
                stepTitle1 = :stepTitle1,
                stepParagraph1 = :stepParagraph1,
                stepTitle2 = :stepTitle2,
                stepParagraph2 = :stepParagraph2,
                stepTitle3 = :stepTitle3,
                stepParagraph3 = :stepParagraph3,
                stepTitle4 = :stepTitle4,
                stepParagraph4 = :stepParagraph4,
                stepTitle5 = :stepTitle5,
                stepParagraph5 = :stepParagraph5,
                stepTitle6 = :stepTitle6,
                stepParagraph6 = :stepParagraph6,
                stepTitle7 = :stepTitle7,
                stepParagraph7 = :stepParagraph7,
                stepTitle8 = :stepTitle8,
                stepParagraph8 = :stepParagraph8
                WHERE id = :id");

            $stmt->bindParam(':title', $guideAchat['title']);
            $stmt->bindParam(':stepTitle1', $guideAchat['stepTitle1']);
            $stmt->bindParam(':stepParagraph1', $guideAchat['stepParagraph1']);
            $stmt->bindParam(':stepTitle2', $guideAchat['stepTitle2']);
            $stmt->bindParam(':stepParagraph2', $guideAchat['stepParagraph2']);
            $stmt->bindParam(':stepTitle3', $guideAchat['stepTitle3']);
            $stmt->bindParam(':stepParagraph3', $guideAchat['stepParagraph3']);
            $stmt->bindParam(':stepTitle4', $guideAchat['stepTitle4']);
            $stmt->bindParam(':stepParagraph4', $guideAchat['stepParagraph4']);
            $stmt->bindParam(':stepTitle5', $guideAchat['stepTitle5']);
            $stmt->bindParam(':stepParagraph5', $guideAchat['stepParagraph5']);
            $stmt->bindParam(':stepTitle6', $guideAchat['stepTitle6']);
            $stmt->bindParam(':stepParagraph6', $guideAchat['stepParagraph6']);
            $stmt->bindParam(':stepTitle7', $guideAchat['stepTitle7']);
            $stmt->bindParam(':stepParagraph7', $guideAchat['stepParagraph7']);
            $stmt->bindParam(':stepTitle8', $guideAchat['stepTitle8']);
            $stmt->bindParam(':stepParagraph8', $guideAchat['stepParagraph8']);
            $id = 1;
            $stmt->bindParam(':id', $id);

            try {
                $stmt->execute();
                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            } finally {
                $dbController->disconnect($conn);
            }
        } else {

            $dbController = new DataBaseController();
            $conn = $dbController->connect();

            $stmt = $conn->prepare("UPDATE guide_achat SET 
                title = :title,
                stepTitle1 = :stepTitle1,
                stepParagraph1 = :stepParagraph1,
                stepTitle2 = :stepTitle2,
                stepParagraph2 = :stepParagraph2,
                stepTitle3 = :stepTitle3,
                stepParagraph3 = :stepParagraph3,
                stepTitle4 = :stepTitle4,
                stepParagraph4 = :stepParagraph4,
                stepTitle5 = :stepTitle5,
                stepParagraph5 = :stepParagraph5,
                stepTitle6 = :stepTitle6,
                stepParagraph6 = :stepParagraph6,
                stepTitle7 = :stepTitle7,
                stepParagraph7 = :stepParagraph7,
                stepTitle8 = :stepTitle8,
                stepParagraph8 = :stepParagraph8,
                image = :image
                WHERE id = :id");

            $stmt->bindParam(':title', $guideAchat['title']);
            $stmt->bindParam(':stepTitle1', $guideAchat['stepTitle1']);
            $stmt->bindParam(':stepParagraph1', $guideAchat['stepParagraph1']);
            $stmt->bindParam(':stepTitle2', $guideAchat['stepTitle2']);
            $stmt->bindParam(':stepParagraph2', $guideAchat['stepParagraph2']);
            $stmt->bindParam(':stepTitle3', $guideAchat['stepTitle3']);
            $stmt->bindParam(':stepParagraph3', $guideAchat['stepParagraph3']);
            $stmt->bindParam(':stepTitle4', $guideAchat['stepTitle4']);
            $stmt->bindParam(':stepParagraph4', $guideAchat['stepParagraph4']);
            $stmt->bindParam(':stepTitle5', $guideAchat['stepTitle5']);
            $stmt->bindParam(':stepParagraph5', $guideAchat['stepParagraph5']);
            $stmt->bindParam(':stepTitle6', $guideAchat['stepTitle6']);
            $stmt->bindParam(':stepParagraph6', $guideAchat['stepParagraph6']);
            $stmt->bindParam(':stepTitle7', $guideAchat['stepTitle7']);
            $stmt->bindParam(':stepParagraph7', $guideAchat['stepParagraph7']);
            $stmt->bindParam(':stepTitle8', $guideAchat['stepTitle8']);
            $stmt->bindParam(':stepParagraph8', $guideAchat['stepParagraph8']);
            $stmt->bindParam(':image', $_FILES['ImagePurchase']['name']);
            $id = 1;
            $stmt->bindParam(':id', $id);

            try {
                $stmt->execute();
                try {
                    $imagesTraitement = new ImagesTraitement();
                    $imagesTraitement->uploadImage('ImagePurchase', '/public/images/guide_achat/');

                } catch (\Throwable $th) {
                    throw new ErrorException($th->getMessage());
                }
                return true;
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            } finally {
                $dbController->disconnect($conn);
            }
        }
        //verifier tous les champs du guide d'achat
    }

}