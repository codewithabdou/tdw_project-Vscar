<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");


if (isset($_POST['model'])) {
    $model = $_POST['model'];
    $versions = (new MarqueController())->getVersionsOfModel($model);
    echo json_encode($versions);
}
?>