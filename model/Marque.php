<?php

//Marque model class

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/DataBase.php');

class MarqueModel
{
    public function getAllMarques()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM marques");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getMarqueByID($marqueID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM marques WHERE ID_Marque = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getMarqueNameByID($marqueID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT Nom FROM marques WHERE ID_Marque = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result["Nom"];
    }

    public function getMarqueByName($marqueName)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM marques WHERE Nom = :marqueName");
        $stmt->bindParam(':marqueName', $marqueName);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function addMarque($marqueName)
    {
        if (empty($marqueName)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO `marques` (`Nom`) VALUES (:marqueName)");
        $stmt->bindParam(':marqueName', $marqueName);
        $stmt->execute();
        $dbController->disconnect($conn);
    }

    public function deleteMarque($marqueID)
    {
        if (empty($marqueID)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM `marques` WHERE ID_Marque = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->execute();
        $dbController->disconnect($conn);
    }

    public function updateMarque($marqueID, $marqueName)
    {
        if (empty($marqueID) || empty($marqueName)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("UPDATE `marques` SET `Nom` = :marqueName WHERE `marques`.`ID_Marque` = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->bindParam(':marqueName', $marqueName);
        $stmt->execute();
        $dbController->disconnect($conn);

    }
}
