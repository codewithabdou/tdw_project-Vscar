<?php
// import The Pages 
require_once($_SERVER['DOCUMENT_ROOT'] . "/tdw_project-Vscar/app/view/AdminViews/Admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/tdw_project-Vscar/app/view/AdminViews/VehiculePage.php");



// Get the Current URL
$request = $_SERVER['REQUEST_URI'];

// remove the last / from the URL 
if ($request[strlen($request) - 1] == '/' && $request != "/tdw_project-Vscar/app/") {
    header("location:" . substr($request, 0, -1));
}
;

if (strpos($request, "?")) {
    $request = substr($request, 0, -(strlen($request) - strpos($request, "?")));
}

if (strpos($request, "/admin")) {
    $request = "/tdw_project-Vscar/admin";
}

// Display Pages 
$adminHomePage = new AdminView();
$adminVehiculesManagementPage = new VehiculePage();


switch ($request) {



    case '/tdw_project-Vscar/app/':
        $adminHomePage->showAdminDashboard();
        break;
    case '/tdw_project-Vscar/vehicules':
        echo "hehe";
        break;


    default:
        break;
}
