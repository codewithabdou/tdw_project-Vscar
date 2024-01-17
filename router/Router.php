<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/Login.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AuthViews/SignUp.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/UsersManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/ReviewsManagement.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/SettingsManagement.php");
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/NewsDetailsView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/VehiculeView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/ContactView.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/NotFoundPage.php");


$request = rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");

$id1 = $_GET['id1'] ?? null;
$id2 = $_GET['id2'] ?? null;
$id3 = $_GET['id3'] ?? null;
$id4 = $_GET['id4'] ?? null;
$userId = $_GET['userId'] ?? null;
$vehiculeId = $_GET['vehiculeId'] ?? null;
$brandId = $_GET['brandId'] ?? null;
$newsId = $_GET['newsId'] ?? null;
$adId = $_GET['adId'] ?? null;


$loginView = new LoginView();
$SignUpView = new SignUpView();
$userHomePage = new UserHomePage();
$adminDashboard = new AdminHomePage();
$adminSettingsManagement = new SettingsManagement();
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
$brandReviewsView = new BrandReviewsView();
$vehiculeReviewsView = new VehiculeReiewsView();
$notFoundPage = new NotFoundPage();
$newsDetailsView = new NewsDetailsView();


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
    case "/vscar/vehiculeReviews":
        if ($vehiculeId)
            $vehiculeReviewsView->displayVehiculeReviewsPage($vehiculeId);
        break;
    case "/vscar/brandReviews":
        if ($brandId)
            $brandReviewsView->displayBrandReviewsPage($brandId);
        break;
    case "/vscar/news":
        if ($newsId)
            $newsDetailsView->displayNewsDetailsPage($newsId);
        else
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
        if (isset($_COOKIE['userId'])) {
            if ($userId)
                $userProfileView->displayUserProfilePage($userId);
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/login":
        $loginView->displayLoginPage();
        break;
    case "/vscar/signup":
        $SignUpView->displaySignUpPage();
        break;
    case "/vscar/admin/dashboard":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            $adminDashboard->displayAdminDashboard();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/vehicules":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            if ($vehiculeId)
                $adminVehiculesManagement->displayAdminVehicule($vehiculeId);
            else
                $adminVehiculesManagement->displayAdminVehicules();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/news":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            if ($newsId)
                $adminNewsManagement->displayAdminNewsUpdate($newsId);
            else
                $adminNewsManagement->displayAdminNews();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/reviews":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            $adminReviewsManagement->displayAdminReviews();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;

    case "/vscar/admin/reviews/vehicules":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            $adminReviewsManagement->displayAdminVehiculeReviews();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/reviews/brands":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            $adminReviewsManagement->displayAdminBrandReviews();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/settings":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            $adminSettingsManagement->displaySettingsManagementPage();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/ads":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            if ($adId)
                $adminSettingsManagement->updateAdForm($adId);
            else
                $adminSettingsManagement->displaySettingsManagementPage();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/users":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            if ($userId)
                $adminUsersManagement->displayAdminUser($userId);
            else
                $adminUsersManagement->displayAdminUsers();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    case "/vscar/admin/brands":
        if (isset($_COOKIE['userId']) && $_COOKIE['userType'] === "Admin") {

            if ($brandId)
                $adminVehiculesManagement->displayAdminBrand($brandId);
            else
                $adminVehiculesManagement->displayAdminVehicules();
        } else {
            $notFoundPage->displayNotFoundPage();

        }
        break;
    default:
        $notFoundPage->displayNotFoundPage();


}