<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");


if (isset($_POST['model']) && isset($_POST['brandId'])) {
    $model = $_POST['model'];
    $brandId = $_POST['brandId'];
    $versions = (new MarqueController())->getVersionsOfModel($model,$brandId);
    echo json_encode($versions);
}
