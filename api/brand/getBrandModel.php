<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");


if (isset($_POST['brandId'])) { 
    $brandId = $_POST['brandId'];
    $models = (new MarqueController())->getModelsOfMarque($brandId);
    echo json_encode($models);
}
