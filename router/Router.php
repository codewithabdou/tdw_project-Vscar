<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/Login.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/SignUp.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/UsersManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/VehiculesManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");



$request = rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");

// get the userId in the request uri after ?userId= if it exists
$userId = $_GET['userId'] ?? null;
$vehiculeId = $_GET['vehiculeId'] ?? null;
$brandId = $_GET['brandId'] ?? null;



$loginView = new LoginView();
$SignUpView = new SignUpView();
$userHomePage = new UserHomePage();
$adminDashboard = new AdminHomePage();
$adminUsersManagement = new UsersManagement();
$adminVehiculesManagement = new VehiculesManagement();

switch ($request) {
    case "/vscar":
        $userHomePage->displayHomePage();
        break;
    case "/vscar/login":
        $loginView->displayLoginPage();
        break;
    case "/vscar/signup":
        echo $SignUpView->displaySignUpPage();
        break;

    case "/vscar/admin/dashboard":
        $adminDashboard->displayAdminDashboard();
        break;
    case "/vscar/admin/vehicules":
        if ($vehiculeId)
            $adminVehiculesManagement->displayAdminVehicule($vehiculeId);
        else
            $adminVehiculesManagement->displayAdminVehicules();
        break;
    case "/vscar/admin/news":
        $adminDashboard->displayAdminNews();
        break;
    case "/vscar/admin/reviews":
        $adminDashboard->displayAdminReviews();
        break;
    case "/vscar/admin/settings":
        $adminDashboard->displayAdminSettings();
        break;
    case "/vscar/admin/users":
        if ($userId)
            $adminUsersManagement->displayAdminUser($userId);
        else
            $adminUsersManagement->displayAdminUsers();
        break;
    case "vscar/admin/brands":
        if ($brandId)
            $adminVehiculesManagement->displayAdminBrand($brandId);
        else
            $adminVehiculesManagement->displayAdminVehicules();
        break;
    case "/vscar/admin/signout":
        $adminDashboard->SignOut();
        break;
    default:
        echo "404";


}