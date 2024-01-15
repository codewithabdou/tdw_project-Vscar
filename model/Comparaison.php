<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Database.php';

class ComparaisonModel
{

    public function twoCarsComparaison($id1, $id2)
    {
        if ($id1 == $id2) {
            throw new Exception("You can't compare the same car");
        }
        $dbController = new DataBaseController();
        $vehiculeController = new VehiculeController();
        $conn = $dbController->connect();
        // verify if both cars exist
        $vehicule1 = $vehiculeController->getVehiculeById($id1);
        $vehicule2 = $vehiculeController->getVehiculeById($id2);
        if ($vehicule1 == null || $vehicule2 == null) {
            throw new Exception("Vehicule not found");
        }


        //verfiy if there is already with same two cars
        $stmt = $conn->prepare("SELECT * FROM comparaisons WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 IS NULL AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 IS NULL AND ID_Véhicule4 IS NULL");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            $stmt = $conn->prepare("UPDATE comparaisons SET Times = Times + 1 WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 IS NULL AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 IS NULL AND ID_Véhicule4 IS NULL");
        } else {
            $stmt = $conn->prepare("INSERT INTO comparaisons (ID_Véhicule1, ID_Véhicule2) VALUES ( :id1, :id2)");
        }

        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->execute();
        $dbController->disconnect($conn);

        return array($vehicule1, $vehicule2);
    }

    public function threeCarsComparaison($id1, $id2, $id3)
    {
        if ($id1 == $id2 || $id1 == $id3 || $id2 == $id3) {
            throw new Exception("You can't compare the same car");
        }
        $dbController = new DataBaseController();
        $vehiculeController = new VehiculeController();
        $conn = $dbController->connect();
        // verify if cars exist
        $vehicule1 = $vehiculeController->getVehiculeById($id1);
        $vehicule2 = $vehiculeController->getVehiculeById($id2);
        $vehicule3 = $vehiculeController->getVehiculeById($id3);
        if ($vehicule1 == null || $vehicule2 == null || $vehicule3 == null) {
            throw new Exception("Vehicule not found");
        }
        //verfiy if there is already with same cars

        $stmt = $conn->prepare("SELECT * FROM comparaisons WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 IS NULL");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->bindParam(':id3', $id3);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            //increment the number of comparaison
            $stmt = $conn->prepare("UPDATE comparaisons SET Times = Times + 1 WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 IS NULL OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 IS NULL");
        } else {

            $stmt = $conn->prepare("INSERT INTO comparaisons (ID_Véhicule1, ID_Véhicule2,ID_Véhicule3) VALUES ( :id1, :id2, :id3)");
        }

        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->bindParam(':id3', $id3);
        $stmt->execute();
        $dbController->disconnect($conn);

        return array($vehicule1, $vehicule2, $vehicule3);
    }

    public function fourCarsComparaison($id1, $id2, $id3, $id4)
    {
        if ($id1 == $id2 || $id1 == $id3 || $id1 == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
            throw new Exception("You can't compare the same car");
        }
        $dbController = new DataBaseController();
        $vehiculeController = new VehiculeController();
        $conn = $dbController->connect();
        // verify if cars exist
        $vehicule1 = $vehiculeController->getVehiculeById($id1);
        $vehicule2 = $vehiculeController->getVehiculeById($id2);
        $vehicule3 = $vehiculeController->getVehiculeById($id3);
        $vehicule4 = $vehiculeController->getVehiculeById($id4);
        if ($vehicule1 == null || $vehicule2 == null || $vehicule3 == null || $vehicule4 == null) {
            throw new Exception("Vehicule not found");
        }
        //verfiy if there is already with same four cars

        $stmt = $conn->prepare("SELECT * FROM comparaisons WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id1");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->bindParam(':id3', $id3);
        $stmt->bindParam(':id4', $id4);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            //increment the number of comparaison
            $stmt = $conn->prepare("UPDATE comparaisons SET Times = Times + 1 WHERE ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id1 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id4 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id2 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id2 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id4 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id3 AND ID_Véhicule2 = :id4 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id1 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id3 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id1 AND ID_Véhicule3 = :id3 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id1 AND ID_Véhicule4 = :id2 OR ID_Véhicule1 = :id4 AND ID_Véhicule2 = :id3 AND ID_Véhicule3 = :id2 AND ID_Véhicule4 = :id1");
        } else {

            $stmt = $conn->prepare("INSERT INTO comparaisons (ID_Véhicule1, ID_Véhicule2,ID_Véhicule3,ID_Véhicule4) VALUES ( :id1, :id2, :id3, :id4)");
        }

        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->bindParam(':id3', $id3);
        $stmt->bindParam(':id4', $id4);
        $stmt->execute();
        $dbController->disconnect($conn);
        return array($vehicule1, $vehicule2, $vehicule3, $vehicule4);
    }

    public function getMostComparedCars()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM comparaisons ORDER BY Times DESC LIMIT 6");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function getMostComparedCarsWithCar($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM comparaisons WHERE ID_Véhicule1 = :id OR ID_Véhicule2 = :id OR ID_Véhicule3 = :id OR ID_Véhicule4 = :id ORDER BY Times DESC LIMIT 6");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }


}