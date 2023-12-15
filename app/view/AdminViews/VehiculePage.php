<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/tdw_project-Vscar/app/controller/Vehicule.php');



class VehiculePage
{
    public function showVehiculesTable()
    {
        $vehiculeController = new VehiculeController();
        $results = $vehiculeController->getAllVehicules();
        // Display the results in an HTML table
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Version</th>
            <th>Year</th>
            <th>Price</th>
            <th>Type</th>
            <th>Specification</th>
            <th>Specification Value</th>
            <th>Brand Name</th>
        </tr>";

        foreach ($results as $vehicle) {
            echo "<tr>
            <td>{$vehicle['ID_Véhicule']}</td>
            <td>{$vehicle['Marque']}</td>
            <td>{$vehicle['Modèle']}</td>
            <td>{$vehicle['Version']}</td>
            <td>{$vehicle['Année']}</td>
            <td>{$vehicle['Prix']}</td>
            <td>{$vehicle['Type']}</td>
            <td>{$vehicle['Nom_Spécification']}</td>
            <td>{$vehicle['Valeur']}</td>
            <td>{$vehicle['MarqueNom']}</td>
          </tr>";
        }
        echo "</table>";

    }
}