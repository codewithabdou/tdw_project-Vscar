<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Comparaison.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Vehicule.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comparaisonController = new ComparaisonController();
    $vehiculeController = new VehiculeController();
    $marque1 = $_POST['Marque1'];
    $modele1 = $_POST['Modèle1'];
    $version1 = $_POST['Version1'];
    $annee1 = $_POST['Année1'];

    $marque2 = $_POST['Marque2'];
    $modele2 = $_POST['Modèle2'];
    $version2 = $_POST['Version2'];
    $annee2 = $_POST['Année2'];

    $marque3 = $_POST['Marque3'];
    $modele3 = $_POST['Modèle3'];
    $version3 = $_POST['Version3'];
    $annee3 = $_POST['Année3'];

    $marque4 = $_POST['Marque4'];
    $modele4 = $_POST['Modèle4'];
    $version4 = $_POST['Version4'];
    $annee4 = $_POST['Année4'];
    $result1234 = null;
    $result123 = null;
    $result124 = null;
    $result134 = null;
    $result234 = null;
    $result12 = null;
    $result13 = null;
    $result14 = null;
    $result23 = null;
    $result24 = null;
    $result34 = null;


    if (isset($annee1) && isset($annee2) && isset($annee3) && isset($annee4)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result1234 = $comparaisonController->fourCarsComparaison($id1, $id2, $id3, $id4);

    }


    if (isset($annee1) && isset($annee2) && isset($annee3)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $result123 = $comparaisonController->threeCarsComparaison($id1, $id2, $id3);
    }

    if (isset($annee1) && isset($annee2) && isset($annee4)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result124 = $comparaisonController->threeCarsComparaison($id1, $id2, $id4);
    }

    if (isset($annee1) && isset($annee3) && isset($annee4)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result134 = $comparaisonController->threeCarsComparaison($id1, $id3, $id4);
    }

    if (isset($annee2) && isset($annee3) && isset($annee4)) {
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result234 = $comparaisonController->threeCarsComparaison($id2, $id3, $id4);
    }
    if (isset($annee1) && isset($annee2)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $result12 = $comparaisonController->twoCarsComparaison($id1, $id2);
    }

    if (isset($annee1) && isset($annee3)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $result13 = $comparaisonController->twoCarsComparaison($id1, $id3);
    }

    if (isset($annee1) && isset($annee4)) {
        $id1 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque1, $modele1, $version1, $annee1);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result14 = $comparaisonController->twoCarsComparaison($id1, $id4);
    }

    if (isset($annee2) && isset($annee3)) {
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $result23 = $comparaisonController->twoCarsComparaison($id2, $id3);
    }

    if (isset($annee2) && isset($annee4)) {
        $id2 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque2, $modele2, $version2, $annee2);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result24 = $comparaisonController->twoCarsComparaison($id2, $id4);
    }

    if (isset($annee3) && isset($annee4)) {
        $id3 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque3, $modele3, $version3, $annee3);
        $id4 = $vehiculeController->getOneVehiculeIDByBrandAndModelAndVersionAndYear($marque4, $modele4, $version4, $annee4);
        $result34 = $comparaisonController->twoCarsComparaison($id3, $id4);
    }

    if (isset($result1234)) {
        $id1 = $result1234[0]['ID_Véhicule'];
        $id2 = $result1234[1]['ID_Véhicule'];
        $id3 = $result1234[2]['ID_Véhicule'];
        $id4 = $result1234[3]['ID_Véhicule'];
        header("Location: /vscar/comparator?id1=$id1&id2=$id2&id3=$id3&id4=$id4");
    } else

        if (isset($result123)) {
            $id1 = $result123[0]['ID_Véhicule'];
            $id2 = $result123[1]['ID_Véhicule'];
            $id3 = $result123[2]['ID_Véhicule'];
            header("Location: /vscar/comparator?id1=$id1&id2=$id2&id3=$id3");
        } else

            if (isset($result124)) {
                $id1 = $result124[0]['ID_Véhicule'];
                $id2 = $result124[1]['ID_Véhicule'];
                $id3 = $result124[2]['ID_Véhicule'];
                header("Location: /vscar/comparator?id1=$id1&id2=$id2&id3=$id3");
            } else

                if (isset($result134)) {
                    $id1 = $result134[0]['ID_Véhicule'];
                    $id3 = $result134[1]['ID_Véhicule'];
                    $id2 = $result134[2]['ID_Véhicule'];
                    header("Location: /vscar/comparator?id1=$id1&id3=$id3&id2=$id2");
                } else

                    if (isset($result234)) {
                        $id2 = $result234[0]['ID_Véhicule'];
                        $id3 = $result234[1]['ID_Véhicule'];
                        $id1 = $result234[2]['ID_Véhicule'];
                        header("Location: /vscar/comparator?id2=$id2&id3=$id3&id1=$id1");
                    } else

                        if (isset($result12)) {
                            $id1 = $result12[0]['ID_Véhicule'];
                            $id2 = $result12[1]['ID_Véhicule'];
                            header("Location: /vscar/comparator?id1=$id1&id2=$id2");
                        } else

                            if (isset($result13)) {
                                $id1 = $result13[0]['ID_Véhicule'];
                                $id2 = $result13[1]['ID_Véhicule'];
                                header("Location: /vscar/comparator?id1=$id1&id2=$id2");
                            } else

                                if (isset($result14)) {
                                    $id1 = $result14[0]['ID_Véhicule'];
                                    $id2 = $result14[1]['ID_Véhicule'];
                                    header("Location: /vscar/comparator?id1=$id1&id2=$id2");
                                } else

                                    if (isset($result23)) {
                                        $id2 = $result23[0]['ID_Véhicule'];
                                        $id1 = $result23[1]['ID_Véhicule'];
                                        header("Location: /vscar/comparator?id2=$id2&id1=$id1");
                                    } else

                                        if (isset($result24)) {
                                            $id2 = $result24[0]['ID_Véhicule'];
                                            $id1 = $result24[1]['ID_Véhicule'];
                                            header("Location: /vscar/comparator?id2=$id2&id1=$id1");
                                        } else

                                            if (isset($result34)) {
                                                $id1 = $result34[0]['ID_Véhicule'];
                                                $id2 = $result34[1]['ID_Véhicule'];
                                                header("Location: /vscar/comparator?id1=$id1&id2=$id2");
                                            } else {
                                                if (session_status() == PHP_SESSION_NONE) {
                                                    session_start();
                                                }
                                                $_SESSION['comparaison_error'] = "select 2 cars at least";
                                                header("Location: /vscar/comparator");
                                            }

}
