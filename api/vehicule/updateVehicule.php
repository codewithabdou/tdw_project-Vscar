<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marqueController = new MarqueController();
    $ID_Vehicule = $_POST['ID_Véhicule'];
    $ID_Marque = $marqueController->getMarqueByName($_POST['marque'])["ID_Marque"];
    $Modele = $_POST['Modèle'];
    $Version = $_POST['Version'];
    $Annee = $_POST['Année'];
    $Prix = $_POST['Prix'];
    $type_carburant = $_POST['type_carburant'];
    $puissance = $_POST['puissance'];
    $acceleration = $_POST['acceleration'];
    $conso_carburant = $_POST['conso_carburant'];
    $longueur = $_POST['longueur'];
    $largeur = $_POST['largeur'];
    $hauteur = $_POST['hauteur'];
    $nb_places = $_POST['nb_places'];
    $volume_coffre = $_POST['volume_coffre'];
    $moteur = $_POST['moteur'];
    $Nom = $_POST['Nom'];

    $vehiculeController = new VehiculeController();

    $vehiculeController->updateVehicule($ID_Vehicule, $Prix, $type_carburant, $puissance, $acceleration, $conso_carburant, $longueur, $largeur, $hauteur, $nb_places, $volume_coffre, $moteur, $Nom);
}
