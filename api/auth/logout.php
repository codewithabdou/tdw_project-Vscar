<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/User.php");

$userController = new UserController();

$userController->logout();


