<?php
//VehiculeController class
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/Vehicule.php');

class VehiculeController
{
    public function getVehiculeByID($vehiculeID)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculeByID($vehiculeID);
    }

    public function getVehiculesByBrandId($brandId)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculesByBrandId($brandId);
    }

    public function updateVehicule($ID_Vehicule, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom)
    {
        $vehiculeModel = new VehiculeModel();
        try {
            $vehiculeModel->updateVehicule($ID_Vehicule, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom);
            header("Location: /vscar/admin/vehicules");
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateVehicule_error'] = $th->getMessage();
            echo $th->getMessage();
            header("Location: /vscar/admin/vehicules");
        }
    }

    public function getOneVehiculeIDByBrandAndModelAndVersionAndYear($brand, $model, $version, $year)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getOneVehiculeIDByBrandAndModelAndVersionAndYear($brand, $model, $version, $year);
    }



    public function getAllVehicules()
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getAllVehicules();
    }

    public function addVehicule($ID_Marque, $Modele, $Version, $Annee, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom)
    {
        $vehiculeModel = new VehiculeModel();
        try {
            $vehiculeModel->addVehicule($ID_Marque, $Modele, $Version, $Annee, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom);
            header("Location: /vscar/admin/brands?brandId=$ID_Marque");
            exit;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['addVehicule_error'] = $th->getMessage();
            header("Location: /vscar/admin/brands?brandId=$ID_Marque");
        }
    }

    public function deleteVehicule($vehiculeID)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->deleteVehicule($vehiculeID);
    }

    public function getVehiculePhotosByID($vehiculeID)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculePhotosByID($vehiculeID);
    }

    public function getVehiculeByMarqueID($marqueID)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculeByMarqueID($marqueID);
    }

    public function getVehiculeByMarqueIDAndModele($marqueID, $modele)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculeByMarqueIDAndModele($marqueID, $modele);
    }

    public function likeVehiculeByUser($userId, $vehiculeId)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->likeVehiculeByUser($userId, $vehiculeId);
    }

    public function unlikeVehiculeByUser($userId, $vehiculeId)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->unlikeVehiculeByUser($userId, $vehiculeId);

    }
    public function IsVehiculeLikedByUser($userId, $vehiculeId)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->IsVehiculeLikedByUser($userId, $vehiculeId);
    }

    public function getVehiculesLikedByUser($userId)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getVehiculesLikedByUser($userId);
    }


}