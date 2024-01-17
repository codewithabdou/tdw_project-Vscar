<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");


if (isset($_POST['version']) && isset($_POST['model']) && isset($_POST['brandId'])) {
    $version = $_POST['version'];
    $brandId = $_POST['brandId'];
    $model = $_POST['model'];
    $years = (new MarqueController())->getYearsofVersion($version,$model,$brandId);
    echo json_encode($years); 
}
