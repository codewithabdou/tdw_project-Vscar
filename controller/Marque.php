<?php

// Marque Controller class

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/Marque.php');

class MarqueController
{
    public function getAllMarques()
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getAllMarques();
    }

    public function getMarqueByID($marqueID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getMarqueByID($marqueID);
    }

    public function getMarqueNameByID($marqueID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getMarqueNameByID($marqueID);
    }

    public function getMarqueByName($marqueName)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getMarqueByName($marqueName);
    }



    public function addMarque($marqueName)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->addMarque($marqueName);
    }

    public function getModelsOfMarque($marqueID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getModelsOfMarque($marqueID);
    }

    public function getVersionsOfModel($model)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getVersionsOfModel($model);
    }

    public function getYearsofVersion($version)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getYearsofVersion($version);
    }

    public function deleteMarque($marqueID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->deleteMarque($marqueID);
    }

    public function updateMarque($ID_Marque, $Nom, $Pays, $Année_de_création, $Siège_social)
    {
        $marqueModel = new MarqueModel();
        try {
            $marqueModel->updateMarque($ID_Marque, $Nom, $Pays, $Année_de_création, $Siège_social);
            header("Location: /vscar/admin/vehicules");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['updateBrand_error'] = $th->getMessage();
            echo $th->getMessage();
            // header("Location: /vscar/admin/brands?brandId=$ID_Marque");
        }
    }

    public function likeBrandByUser($userID, $brandID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->likeBrandByUser($userID, $brandID);

    }

    public function unlikeBrandByUser($userID, $brandID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->unlikeBrandByUser($userID, $brandID);
    }

    public function IsBrandLikedByUser($userID, $brandID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->IsBrandLikedByUser($userID, $brandID);
    }

    public function getBrandsLikedByUser($userID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->getBrandsLikedByUser($userID);
    }
}
