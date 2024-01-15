<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/DataBase.php');



class VehiculeModel
{
    public function getVehiculeByID($vehiculeID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getVehiculesByBrandId($brandId)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Marque = :brandId");
        $stmt->bindParam(':brandId', $brandId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }
    public function updateVehicule($vehiculeID, $prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom)
    {
        if (empty($prix) || empty($vehiculeID) || empty($type_carburant) || empty($puissance) || empty($acceleration) || empty($conso_carburant) || empty($longueur) || empty($largeur) || empty($hauteur) || empty($nb_places) || empty($volume_coffre) || empty($moteur) || empty($Nom)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);

        if ($result === null) {
            throw new ErrorException("Vehicule doesn't exist");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("UPDATE `véhicules`
        SET `Prix` = :prix,
            `Type_Carburant` = :type_carburant,
            `Puissance` = :puissance,
            `Acceleration` = :acceleration,
            `Conso_Carburant` = :conso_carburant,
            `Longueur` = :longueur,
            `Largeur` = :largeur,
            `Hauteur` = :hauteur,
            `Nb_Places` = :nb_places,
            `Volume_Coffre` = :volume_coffre,
            `Moteur` = :moteur,
            `Nom` = :Nom
        WHERE ID_Véhicule = :vehiculeID
    ");

        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':type_carburant', $type_carburant);
        $stmt->bindParam(':puissance', $puissance);
        $stmt->bindParam(':acceleration', $acceleration);
        $stmt->bindParam(':conso_carburant', $conso_carburant);
        $stmt->bindParam(':longueur', $longueur);
        $stmt->bindParam(':largeur', $largeur);
        $stmt->bindParam(':hauteur', $hauteur);
        $stmt->bindParam(':nb_places', $nb_places);
        $stmt->bindParam(':volume_coffre', $volume_coffre);
        $stmt->bindParam(':moteur', $moteur);
        $stmt->bindParam(':Nom', $Nom);
        $stmt->bindParam(':vehiculeID', $vehiculeID);

        $stmt->execute();

        // $this->updateVehiculePhoto($photo, $vehiculeID);
        $dbController->disconnect($conn);
        return true;
    }

    public function getOneVehiculeIDByBrandAndModelAndVersionAndYear($brand, $model, $version, $year)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Marque = :brand AND Modèle = :model AND Version = :version AND Année = :year LIMIT 1");
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':version', $version);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result['ID_Véhicule'];
    }


    public function updateVehiculePhoto($photo, $vehiculeID)
    {
        if (empty($photo) || empty($vehiculeID)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        if ($result === null) {
            throw new ErrorException("Vehicule doesn't exist");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("UPDATE `photos_véhicule`
        SET `Photo` = :photo
        WHERE ID_Véhicule = :vehiculeID
        ");
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $dbController->disconnect($conn);
        return true;
    }

    public function getVehiculePhotosByID($vehiculeID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM photos WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getAllVehicules()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function addVehicule($ID_Marque, $Modele, $Version, $Annee, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO `véhicules` (
            `ID_Marque`, 
            `Modèle`, 
            `Version`, 
            `Année`, 
            `Prix`, 
            `type_carburant`, 
            `puissance`, 
            `acceleration`, 
            `conso_carburant`, 
            `longueur`, 
            `largeur`, 
            `hauteur`, 
            `nb_places`, 
            `volume_coffre`, 
            `moteur`,
            `Nom`
            ) VALUES ( :ID_Marque, :Modele, :Version, :Annee, :Prix, :type_carburant, :puissance, :acceleration, :conso_carburant, :longueur, :largeur, :hauteur, :nb_places, :volume_coffre, :moteur, :Nom)");
        $stmt->bindParam(':ID_Marque', $ID_Marque);
        $stmt->bindParam(':Modele', $Modele);
        $stmt->bindParam(':Version', $Version);
        $stmt->bindParam(':Annee', $Annee);
        $stmt->bindParam(':Prix', $Prix);
        $stmt->bindParam(':type_carburant', $type_carburant);
        $stmt->bindParam(':puissance', $puissance);
        $stmt->bindParam(':acceleration', $acceleration);
        $stmt->bindParam(':conso_carburant', $conso_carburant);
        $stmt->bindParam(':longueur', $longueur);
        $stmt->bindParam(':largeur', $largeur);
        $stmt->bindParam(':hauteur', $hauteur);
        $stmt->bindParam(':nb_places', $nb_places);
        $stmt->bindParam(':volume_coffre', $volume_coffre);
        $stmt->bindParam(':moteur', $moteur);
        $stmt->bindParam(':Nom', $Nom);

        $stmt->execute();
        // $vehiculeID = $conn->lastInsertId();
        // $stmt = $conn->prepare("INSERT INTO `photos_véhicule`(`ID_Véhicule`, `Photo`) VALUES (:vehiculeID,:photo)");
        // $stmt->bindParam(':vehiculeID', $vehiculeID);
        // $stmt->bindParam(':photo', $photo);
        // $stmt->execute();
        $dbController->disconnect($conn);
        return true;
    }

    public function deleteVehicule($vehiculeID)
    {
        if (empty($vehiculeID)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        if ($result === null) {
            throw new ErrorException("Vehicule doesn't exist");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM `véhicules` WHERE ID_Véhicule = :vehiculeID");
        $stmt->bindParam(':vehiculeID', $vehiculeID);
        $stmt->execute();
        $dbController->disconnect($conn);
        return true;
    }

    public function getVehiculeByMarqueID($marqueID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Marque = :marqueID");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getVehiculeByMarqueIDAndModele($marqueID, $modele)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM véhicules WHERE ID_Marque = :marqueID AND Modèle = :modele");
        $stmt->bindParam(':marqueID', $marqueID);
        $stmt->bindParam(':modele', $modele);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function likeVehiculeByUser($userId, $vehiculeId)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO `véhicules_aimer`(`ID_Utilisateur`, `ID_Véhicule`) VALUES (:userId,:vehiculeId)");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':vehiculeId', $vehiculeId);
            $stmt->execute();
            $dbController->disconnect($conn);
            return true;
        } catch (\Throwable $th) {
            $dbController->disconnect($conn);
            return false;
        }
    }

    public function unlikeVehiculeByUser($userId, $vehiculeId)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM `véhicules_aimer` WHERE ID_Utilisateur = :userId AND ID_Véhicule = :vehiculeId");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':vehiculeId', $vehiculeId);
            $stmt->execute();
            $dbController->disconnect($conn);
            return true;
        } catch (\Throwable $th) {
            $dbController->disconnect($conn);
            return false;
        }
    }

    public function getVehiculesLikedByUser($userId)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT véhicules.* FROM `véhicules_aimer` INNER JOIN véhicules ON véhicules_aimer.ID_Véhicule = véhicules.ID_Véhicule WHERE véhicules_aimer.ID_Utilisateur = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    

    public function IsVehiculeLikedByUser($userId, $vehiculeId)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM `véhicules_aimer` WHERE ID_Utilisateur = :userId AND ID_Véhicule = :vehiculeId");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':vehiculeId', $vehiculeId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }








}