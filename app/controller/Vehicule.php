<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/tdw_project-Vscar/app/model/Vehicule.php');

class VehiculeController
{
    public function getAllVehicules()
    {
        $vehiculeModel = new VehiculeModel();
        return $vehiculeModel->getAllVehicules();
    }
}