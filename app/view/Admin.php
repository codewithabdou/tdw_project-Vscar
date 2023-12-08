<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/tdw_project-Vscar/app/controller/DataBase.php');

$dbController = new DataBaseController();
$dbController->connect();

?>