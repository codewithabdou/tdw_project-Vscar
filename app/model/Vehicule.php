<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/tdw_project-Vscar/app/controller/DataBase.php');



class VehiculeModel
{
    public function getAllVehicules()
    {
        $db = new DataBaseController();
        $conn = $db->connect();

        $sql = "SELECT V.ID_Véhicule, V.Marque, V.Modèle, V.Version, V.Année, V.Prix,
        T.Nom_Type AS Type,
        S.Nom_Spécification, VS.Valeur,
        M.Nom AS MarqueNom
        FROM Véhicules V
        INNER JOIN Types_Véhicules T ON V.ID_Type = T.ID_Type
        LEFT JOIN Véhicule_Spécifications VS ON V.ID_Véhicule = VS.ID_Véhicule
        LEFT JOIN Spécifications S ON VS.ID_Spécification = S.ID_Spécification
        LEFT JOIN Marques M ON V.ID_Type = M.ID_Marque";

        $query = $conn->prepare($sql);
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);


        $db->disconnect($conn);
        return $results;

    }
}