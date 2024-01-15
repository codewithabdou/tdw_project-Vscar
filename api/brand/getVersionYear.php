<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");


if (isset($_POST['version'])) {
    $model = $_POST['version'];
    $years = (new MarqueController())->getYearsofVersion($model);
    echo json_encode($years);
}
?>