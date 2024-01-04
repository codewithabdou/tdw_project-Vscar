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

    public function deleteMarque($marqueID)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->deleteMarque($marqueID);
    }

    public function updateMarque($marqueID, $marqueName)
    {
        $marqueModel = new MarqueModel();
        return $marqueModel->updateMarque($marqueID, $marqueName);
    }
}
