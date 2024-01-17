<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/review.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/user.php");

class ReviewsManagement
{

    public function displayAdminReviews()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminReviewsContent();
    }

    public function displayAdminReviewsContent()
    {
        ?>
        <h1 class="mt-5">Reviews Management</h1>
        <div class=" flex-centered mt-5">
            <div class="d-flex  justify-content-center align-items-center flex-wrap g-3 ">
                <a href="/vscar/admin/reviews/vehicules" class="card custom-card">
                    <div class="card-body ">
                        <h5 class="card-title">Vehicules Reviews </h5>
                    </div>
                </a>
                <a href="/vscar/admin/reviews/brands" class="card  custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Brands Reviews </h5>
                    </div>
                </a>
            </div>
        </div>
        <?php

    }

    public function displayAdminVehiculeReviews()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminVehiculeReviewsContent();
    }

    public function displayAdminVehiculeReviewsContent()
    {
        $reviewscontroller = new ReviewController();
        $userController = new UserController();

        $vehiculesReviews = $reviewscontroller->getVehiculesReviews();

        $statusFilter = isset($_GET['status']) ? $_GET['status'] : ''; 

        ?>

        <div class="container mt-5">
            <h2>Vehicules Reviews Management</h2>

            <div class="form-group mt-5">
                <input type="text" class="form-control" id="searchVehiculesReviewsInput" placeholder="Search...">
            </div>

            <div class="form-group">
                <label for="statusFilter">Filter by Status:</label>
                <select class="form-control" id="statusFilter" name="status">
                    <option value="">All</option>
                    <option value="Pending" <?php echo ($statusFilter == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Validated" <?php echo ($statusFilter == 'Validated') ? 'selected' : ''; ?>>Validated</option>
                </select>
            </div>

            <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="ID">ID</th>
                        <th data-sortable="true" data-field="Owner">Owner</th>
                        <th data-sortable="true" data-field="Comment">Comment</th>
                        <th data-sortable="true" data-field="Status">Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiculesReviews as $review) {
                        if ($statusFilter == '' || $review["Statut"] == $statusFilter) {
                            ?>
                            <tr>
                                <td>
                                    <?= $review["ID_Avis"]; ?>
                                </td>
                                <td>
                                    <?= $userController->getUserByID($review["ID_Utilisateur"])["Nom"] . " " . $userController->getUserByID($review["ID_Utilisateur"])["Prénom"]; ?>
                                </td>
                                <td>
                                    <?= $review["Commentaire"]; ?>
                                </td>
                                <td class="status">
                                    <?= $review["Statut"]; ?>
                                </td>
                                <td class="d-flex pl-3  ">
                                    <?php if ($userController->getUserByID($review["ID_Utilisateur"])["Statut"] == "Actif") { ?>
                                        <div class="mr-3">
                                            <button onclick='blockUser(<?= $review["ID_Utilisateur"]; ?>)' class="btn btn-danger ">block
                                                user</button>
                                        </div>
                                    <?php } ?>


                                    <div class="mr-3">
                                        <button onclick='deleteVehiculeReview(<?= $review["ID_Avis"]; ?>)'
                                            class="btn btn-danger ">Delete
                                            review</button>
                                    </div>
                                    <?php if ($review["Statut"] == "Pending") { ?>
                                        <div class="mr-3">
                                            <button onclick='acceptVehiculeReview(<?= $review["ID_Avis"]; ?>)'
                                                class="btn btn-success ">Accept
                                                review</button>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php

    }

    public function displayAdminBrandReviews()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminBrandReviewsContent();
    }

    public function displayAdminBrandReviewsContent()
    {
        $reviewscontroller = new ReviewController();
        $userController = new UserController();

        $brandsReviews = $reviewscontroller->getBrandsReviews();


        $statusFilter = isset($_GET['status']) ? $_GET['status'] : ''; 

        ?>

            <div class="container mt-5">
                <h2>Brands Reviews Management</h2>

                <div class="form-group mt-5">
                    <input type="text" class="form-control" id="searchBrandsReviewsInput" placeholder="Search...">
                </div>

                <div class="form-group">
                    <label for="statusFilter">Filter by Status:</label>
                    <select class="form-control" id="statusFilter" name="status">
                        <option value="">All</option>
                        <option value="Pending" <?php echo ($statusFilter == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Validated" <?php echo ($statusFilter == 'Validated') ? 'selected' : ''; ?>>Validated
                        </option>
                    </select>
                </div>

                <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="ID">ID</th>
                            <th data-sortable="true" data-field="Owner">Owner</th>
                            <th data-sortable="true" data-field="Comment">Comment</th>
                            <th data-sortable="true" data-field="Status">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($brandsReviews as $review) {
                            if ($statusFilter == '' || $review["Statut"] == $statusFilter) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $review["ID_Avis"]; ?>
                                    </td>
                                    <td>
                                        <?= $userController->getUserByID($review["ID_Utilisateur"])["Nom"] . " " . $userController->getUserByID($review["ID_Utilisateur"])["Prénom"]; ?>
                                    </td>
                                    <td>
                                        <?= $review["Commentaire"]; ?>
                                    </td>
                                    <td class="status">
                                        <?= $review["Statut"]; ?>
                                    </td>
                                    <td class="d-flex pl-3  ">
                                        <?php if ($userController->getUserByID($review["ID_Utilisateur"])["Statut"] == "Actif") { ?>
                                            <div class="mr-3">
                                                <button onclick='blockUser(<?= $review["ID_Utilisateur"]; ?>)' class="btn btn-danger ">block
                                                    user</button>
                                            </div>
                                        <?php } ?>
                                        <div class="mr-3">
                                            <button onclick='deleteBrandReview(<?= $review["ID_Avis"]; ?>)'
                                                class="btn btn-danger ">Delete
                                                review</button>
                                        </div>
                                        <?php if ($review["Statut"] == "Pending") { ?>
                                            <div class="mr-3">
                                                <button onclick='acceptBrandReview(<?= $review["ID_Avis"]; ?>)'
                                                    class="btn btn-success ">Accept
                                                    review</button>
                                            </div>
                                        <?php } ?>


                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>


                <?php


    }
}