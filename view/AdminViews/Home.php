<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");

class AdminHomePage
{



    public function displayAdminDashboard()
    {
        $this->displayAdminSideBar();
        $this->displayAdminDashboardContent();
    }



    public function displayAdminNews()
    {
        $this->displayAdminSideBar();
        $this->displayAdminNewsContent();
    }

    public function displayAdminReviews()
    {
        $this->displayAdminSideBar();
        $this->displayAdminReviewsContent();
    }

    public function displayAdminSettings()
    {
        $this->displayAdminSideBar();
        $this->displayAdminSettingsContent();
    }








    public function displayAdminSettingsContent()
    {

    }



    public function displayAdminReviewsContent()
    {

    }

    public function displayAdminNewsContent()
    {

    }

    public function SignOut()
    {
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session if it's not already started
            session_start();
        }
        session_destroy();
        header("Location: /vscar/login");
    }

    public function displayAdminSideBar()
    {
        ?>
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="/vscar/admin/dashboard" class="nav_logo">
                        <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">VsCar</span>
                    </a>
                    <div class="nav_list">
                        <a href="/vscar/admin/dashboard" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/dashboard")
                            echo "active" ?>">
                                <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span>
                            </a>
                            <a href="/vscar/admin/users" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/users")
                            echo "active" ?>"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span>
                            </a> <a href="/vscar/admin/vehicules" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/vehicules")
                            echo "active" ?>"> <i class='bx bxs-car nav_icon'></i> <span
                                    class="nav_name">Vehicules</span>
                            </a>
                            <a href="/vscar/admin/news" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/news")
                            echo "active" ?>">
                                <i class='bx bx-news nav_icon'></i> <span class="nav_name">News</span>
                            </a>
                            <a href="/vscar/admin/reviews" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/reviews")
                            echo "active" ?>">
                                <i class='bx bx-comment nav_icon'></i> <span class="nav_name">Reviews</span>
                            </a>
                            <a href="/vscar/admin/settings" class="nav_link <?php if (rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/") === "/vscar/admin/settings")
                            echo "active" ?>">
                                <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span>
                            </a>
                        </div>
                    </div> <a href="/vscar/admin/signout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">Sign
                            out</span> </a>
                </nav>
            </div>
        <?php
    }

    public function displayAdminDashboardContent()
    {
        ?>
        <div class=" flex-centered height-100">
            <div class="d-flex  justify-content-center align-items-center flex-wrap g-3 ">
                <a href="/vscar/admin/vehicules" class="card custom-card">
                    <div class="card-body ">
                        <h5 class="card-title">Vehicules </h5>
                    </div>
                </a>
                <a href="/vscar/admin/users" class="card  custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Users </h5>
                        <!-- Add other card content here if needed -->
                    </div>
                </a>
                <a href="/vscar/admin/news" class="card  custom-card">
                    <div class="card-body">
                        <h5 class="card-title">News </h5>
                        <!-- Add other card content here if needed -->
                    </div>
                </a>
                <a href="/vscar/admin/reviews" class="card  custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Reviews</h5>
                        <!-- Add other card content here if needed -->
                    </div>
                </a>
                <a href="/vscar/admin/settings" class="card  custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Settings</h5>
                        <!-- Add other card content here if needed -->
                    </div>
                </a>
            </div>
        </div>
        <?php
    }
}
