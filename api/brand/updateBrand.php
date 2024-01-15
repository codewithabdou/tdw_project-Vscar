<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $marqueController = new MarqueController();
    $ID_Marque = $_POST['ID_Marque'];
    $Nom = $_POST['Nom'];
    $Pays = $_POST['Pays_d_origine'];
    $Année_de_création = $_POST['Année_de_création'];
    $Siège_social = $_POST['Siège_social'];
    $marqueController->updateMarque($ID_Marque, $Nom, $Pays, $Année_de_création, $Siège_social);
}