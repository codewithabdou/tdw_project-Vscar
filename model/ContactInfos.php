<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/DataBase.php");

class ContactInfosModel{
    public function getContactInfos(){
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM contact_infos");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function updateContactInfos($adresse,$email,$numero){
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("UPDATE contact_infos SET adresse = :adresse, email = :email, numéro = :numero WHERE id = 1");
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':numero', $numero);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }
}