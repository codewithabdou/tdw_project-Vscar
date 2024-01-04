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

    public function updateVehicule($ID_Vehicule, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom)
    {
        $vehiculeModel = new VehiculeModel();
        try {
            $vehiculeModel->updateVehicule($ID_Vehicule, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom);
            header("Location: /vscar/admin/vehicules");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['updateVehicule_error'] = $th->getMessage();
            header("Location: /vscar/admin/vehicules?vehiculeId=$ID_Vehicule");
        }
    }

    public function updateVehiculePhoto($photo, $vehiculeID)
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->updateVehiculePhoto($photo, $vehiculeID);
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
            header("Location: /vscar/admin/vehicules");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['addVehicule_error'] = $th->getMessage();
            header("Location: /vscar/admin/vehicules");
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


}