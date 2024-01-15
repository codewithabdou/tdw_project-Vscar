<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/Login.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/SignUp.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/UsersManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/ReviewsManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/NewsManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/VehiculesManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/BrandsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/ComparatorView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/GuideView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/NewsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/ReviewsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/SingleBrandView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/UserProfileView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/VehiculeReviewsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/BrandReviewsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/VehiculeView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/ContactView.php");


$request = rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");

$id1 = $_GET['id1'] ?? null;
$id2 = $_GET['id2'] ?? null;
$id3 = $_GET['id3'] ?? null;
$id4 = $_GET['id4'] ?? null;
$userId = $_GET['userId'] ?? null;
$vehiculeId = $_GET['vehiculeId'] ?? null;
$brandId = $_GET['brandId'] ?? null;
$newsId = $_GET['newsId'] ?? null;


$loginView = new LoginView();
$SignUpView = new SignUpView();
$userHomePage = new UserHomePage();
$adminDashboard = new AdminHomePage();
$adminUsersManagement = new UsersManagement();
$adminVehiculesManagement = new VehiculesManagement();
$adminReviewsManagement = new ReviewsManagement();
$adminNewsManagement = new NewsManagement();
$contactView = new ContactView();
$reviewView = new ReviewsView();
$newsView = new NewsView();
$guideView = new GuideView();
$brandsView = new BrandsView();
$comparatorView = new ComparatorView();
$userProfileView = new UserProfileView();
$vehiculeView = new VehiculeView();
$singleBrandView = new SingleBrandView();
$userProfileView = new UserProfileView();


switch ($request) {
    case "/vscar":
        $userHomePage->displayHomePage();
        break;
    case "/vscar/contact":
        $contactView->displayContactPage();
        break;
    case "/vscar/reviews":
        $reviewView->displayReviewsPage();
        break;
    case "/vscar/news":
        $newsView->displayNewsPage();
        break;
    case "/vscar/guide":
        $guideView->displayGuidePage();
        break;
    case "/vscar/brands":
        if ($brandId)
            $singleBrandView->displayBrandPage($brandId);
        else
            $brandsView->displayBrandsPage();
        break;
    case "/vscar/comparator":
        if ($id1 && $id2 && $id3 && $id4)
            $comparatorView->displayComparatorPageFour($id1, $id2, $id3, $id4);
        else if ($id1 && $id2 && $id3)
            $comparatorView->displayComparatorPageThree($id1, $id2, $id3);
        else if ($id1 && $id2)
            $comparatorView->displayComparatorPageTwo($id1, $id2);
        else
            $comparatorView->displayComparatorPage();
        break;
    case "/vscar/vehicule":
        if ($vehiculeId)
            $vehiculeView->displayVehiculePage($vehiculeId);
        break;
    case "/vscar/userProfile":
        if ($userId)
            $userProfileView->displayUserProfilePage($userId);
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
        if ($newsId)
            $adminNewsManagement->displayAdminNewsUpdate($newsId);
        else
            $adminNewsManagement->displayAdminNews();
        break;
    case "/vscar/admin/reviews":
        $adminReviewsManagement->displayAdminReviews();
        break;
    case "/vscar/admin/reviews/vehicules":
        $adminReviewsManagement->displayAdminVehiculeReviews();
        break;
    case "/vscar/admin/reviews/brands":
        $adminReviewsManagement->displayAdminBrandReviews();
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
    case "/vscar/admin/brands":
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