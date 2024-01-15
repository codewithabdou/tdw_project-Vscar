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

    public function updateMarque($ID_Marque, $Nom, $Pays, $Année_de_création, $Siège_social)
    {
        if (empty($ID_Marque) || empty($Nom) || empty($Pays) || empty($Année_de_création) || empty($Siège_social)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("UPDATE `marques` SET `Nom`='$Nom',`Pays_d_origine`='$Pays',`Siège_social`='$Siège_social',`Année_de_création`='$Année_de_création' WHERE `ID_Marque`='$ID_Marque'");



        echo $stmt->queryString;


        $stmt->execute();


        $dbController->disconnect($conn);
        return true;
    }

    public function getModelsOfMarque($marqueID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM `véhicules` WHERE `ID_Marque` = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $models = [];
        foreach ($result as $row) {
            //check if model already exists
            if (in_array($row["Modèle"], $models)) {
                continue;
            }
            $models[] = $row["Modèle"];
        }
        $dbController->disconnect($conn);
        return $models;
    }

    public function getYearsofVersion($version)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM `véhicules` WHERE `Version` = :version");
        $stmt->bindParam(':version', $version);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $years = [];
        foreach ($result as $row) {
            //check if year already exists
            if (in_array($row["Année"], $years)) {
                continue;
            }
            $years[] = $row["Année"];
        }
        $dbController->disconnect($conn);
        return $years;
    }

    public function getVersionsofModel($model)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM `véhicules` WHERE `Modèle` = :model");
        $stmt->bindParam(':model', $model);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $versions = [];
        foreach ($result as $row) {
            //check if version already exists
            if (in_array($row["Version"], $versions)) {
                continue;
            }
            $versions[] = $row["Version"];
        }
        $dbController->disconnect($conn);
        return $versions;
    }

    public function likeBrandByUser($userID, $brandID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO `marques_aimer` (`ID_Utilisateur`, `ID_Marque`) VALUES (:userID, :brandID)");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':brandID', $brandID);
        $stmt->execute();
        $dbController->disconnect($conn);
    }

    public function unlikeBrandByUser($userID, $brandID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM `marques_aimer` WHERE `ID_Utilisateur` = :userID AND `ID_Marque` = :brandID");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':brandID', $brandID);
        $stmt->execute();
        $dbController->disconnect($conn);
    }

    public function IsBrandLikedByUser($userID, $brandID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM `marques_aimer` WHERE `ID_Utilisateur` = :userID AND `ID_Marque` = :brandID");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':brandID', $brandID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getBrandsLikedByUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT marques.* FROM `marques_aimer` INNER JOIN marques ON marques_aimer.ID_Marque = marques.ID_Marque WHERE marques_aimer.ID_Utilisateur = :userId");
        $stmt->bindParam(':userId', $userID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }


}
