<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/Comparaison.php');

class ComparaisonController
{


    public function twoCarsComparaison($id1, $id2)
    {
        $comparaisonModel = new ComparaisonModel();
        try {
            $result = $comparaisonModel->twoCarsComparaison($id1, $id2);
            return $result;
        } catch (Exception $e) {
            $result = $e->getMessage();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['comparaison_error'] = $result;
            header("Location: /vscar/comparator?id1=$id1&id2=$id2");
        }
    }

    public function threeCarsComparaison($id1, $id2, $id3)
    {
        $comparaisonModel = new ComparaisonModel();
        try {
            $result = $comparaisonModel->threeCarsComparaison($id1, $id2, $id3);
            return $result;
        } catch (Exception $e) {
            $result = $e->getMessage();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['comparaison_error'] = $result;
            header("Location: /vscar/comparator?id1=$id1&id2=$id2&id3=$id3");

        }
    }

    public function fourCarsComparaison($id1, $id2, $id3, $id4)
    {
        $comparaisonModel = new ComparaisonModel();
        try {
            $result = $comparaisonModel->fourCarsComparaison($id1, $id2, $id3, $id4);
            return $result;
        } catch (Exception $e) {
            $result = $e->getMessage();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['comparaison_error'] = $result;
            header("Location: /vscar/comparator?id1=$id1&id2=$id2&id3=$id3&id4=$id4");
        }
    }

    public function getMostComparedCars()
    {
        $comparaisonModel = new ComparaisonModel();
        try {
            $result = $comparaisonModel->getMostComparedCars();
            return $result;
        } catch (Exception $e) {
            $result = $e->getMessage();
            return $result;
        }
    }

    public function getMostComparedCarsWithCar($id)
    {
        $comparaisonModel = new ComparaisonModel();
        try {
            $result = $comparaisonModel->getMostComparedCarsWithCar($id);
            return $result;
        } catch (Exception $e) {
            $result = $e->getMessage();
            return $result;
        }
    }
}

