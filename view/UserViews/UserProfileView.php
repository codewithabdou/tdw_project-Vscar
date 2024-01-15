<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Vehicule.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Review.php");

class UserProfileView
{

    public function displayUserProfilePage($id)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();

        $userController = new userController();
        $user = $userController->getUserById($id);
        $this->displayUserDetails($id);
        $this->displayUserLikedItems($id);
        $home->displayFooter();
    }

    public function displayUserDetails($id)
    {
        $userController = new UserController();
        $user = $userController->getUserById($id);
        ?>
        <div>
            <!-- Page Content -->
            <div class="container mt-3">
                <div class="jumbotron">
                    <h1 class="display-4">Profile page</h1>
                    <p class="lead">See everything you have done in our website.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <img src='/vscar/public/images/users/<?= $user["Image"]; ?>' class="img-fluid" alt="User Image">



                    </div>
                    <div class="d-flex col-md-6 align-items-center justify-content-center">
                        <form class="container bg-light p-4 rounded" action="/vscar/api/user/updateUser.php" method="POST">
                            <input hidden value="<?php echo $user['ID_Utilisateur']; ?>" name="userId">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="Nom">First name</label>
                                    <input value="<?php echo $user['Nom']; ?>" class="form-control" type="text" name="Nom">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="Prénom">Last name</label>
                                    <input value="<?php echo $user['Prénom']; ?>" class="form-control" type="text"
                                        name="Prénom">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="Username">Username</label>
                                    <input value="<?php echo $user['Username']; ?>" class="form-control" type="text"
                                        name="Username" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="Sexe">Gender</label>
                                    <select class="form-control" id="Sexe" name="Sexe">
                                        <option value="Male" <?php echo ($user['Sexe'] == 'Male') ? 'selected' : ''; ?>>Male
                                        </option>
                                        <option value="Female" <?php echo ($user['Sexe'] == 'Female') ? 'selected' : ''; ?>>Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="Date_de_naissance">Birthday</label>
                                    <input value="<?php echo $user['Date_de_naissance']; ?>" class="form-control" type="date"
                                        name="Date_de_naissance">
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['updateUser_error'])) {
                                echo '<div class="text-danger">' . $_SESSION['updateUser_error'] . '</div>';
                                unset($_SESSION['updateUser_error']);
                            }
                            ?>
                            <input hidden value="user" name="from">
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php

    }

    public function displayUserLikedItems($id)
    {
        $vehiculeController = new VehiculeController();
        $marqueController = new MarqueController();
        $reviewController = new ReviewController();
        $userController = new UserController();
        $vehicules = $vehiculeController->getVehiculesLikedByUser($id);
        $brands = $marqueController->getBrandsLikedByUser($id);
        $vehiculesLikedReviews = $reviewController->getVehiculesReviewsLikedByUser($id);
        $brandsReviews = $reviewController->getBrandsReviewsLikedByUser($id);
        $vehiculesUserReviews = $reviewController->getVehiculeReviewByUserId($id);
        $brandsUserReviews = $reviewController->getBrandReviewByUserId($id);
        ?>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Liked brands</h2>
                </div>
            </div>
            <div class="row px-5">
                <?php
                if (count($brands) == 0) {
                    echo '<div class="col-12 px-5">';
                    echo '<h3 class="text-center">No liked brands yet</h3>';
                    echo '</div>';
                }
                foreach ($brands as $brand) {
                    echo '<div class="col-4 d-flex flex-column justify-content-center align-items-center">';
                    echo '<a href="/vscar/brands?brandId=' . $brand['ID_Marque'] . '">';
                    echo '<img src="/vscar/public/images/brands/' . $brand['Photo'] . '" alt="' . $brand['Nom'] . '" class="img-fluid" style="width : 80%;">';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>

        </div>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Liked Cars</h2>
                </div>
            </div>
            <div class="row px-5">
                <?php
                if (count($vehicules) == 0) {
                    echo '<div class="col-12 px-5">';
                    echo '<h3 class="text-center">No liked cars yet</h3>';
                    echo '</div>';
                }
                foreach ($vehicules as $vehicule) {
                    echo '<a href="/vscar/vehicule?vehiculeId=' . $vehicule['ID_Véhicule'] . '" class="col-4 jumbotron rounded border d-flex flex-column justify-content-center align-items-center">';
                    echo '<img src="/vscar/public/images/vehicules/' . $vehicule['Photo'] . '" alt="' . $vehicule['Nom'] . '" class="img-fluid" style="width : 80%;">';
                    echo '<p style="font-weight : 900; font-size : 2rem;" class="text-center">' . $vehicule['Nom'] . '</p>';

                    echo '</a>';
                }
                ?>
            </div>

        </div>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Liked Reviews</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <?php
                    if (empty($vehiculesLikedReviews)) {
                        echo '<h3 class="text-center">No Liked Cars Reviews Yet</h3>';
                    } else
                        echo '<h3 class="text-center">Cars reviews</h3>';

                    foreach ($vehiculesLikedReviews as $review) {

                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center p-1">
                                    <p style="font-weight: 900;">
                                        <img style="border: 1px solid black;" class="rounded-circle"
                                            src="/vscar/public/images/users/<?= $userController->getUserByID($review['ID_Utilisateur'])['Photo']; ?>" />

                                        <?php
                                        echo $userController->getUserByID($review['ID_Utilisateur'])['Username'];
                                        ?>

                                    </p>
                                    <div>
                                        <?php
                                        if ($review['Note'] == 4) {
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 3) {
                                            for ($i = 0; $i < 3; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 2) {
                                            for ($i = 0; $i < 2; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 1) {
                                            for ($i = 0; $i < 1; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 5) {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        if (isset($_COOKIE['userId']) && $review['ID_Utilisateur'] == $_COOKIE['userId']) {
                                            ?>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                Delete
                                            </button>
                                            <?php
                                        }
                                        if (isset($_COOKIE['userId']) && $reviewController->IsUserLikingVehiculeReview($_COOKIE['userId'], $review['ID_Avis'])) {
                                            ?>
                                            <button class="btn btn-secondary btn-sm"
                                                onclick="unlikeVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                Unlike
                                            </button>
                                            <?php
                                        } else if (isset($_COOKIE['userId'])) {
                                            ?>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="likeVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                    Like
                                                </button>
                                            <?php
                                        }


                                        ?>

                                    </div>


                                </div>
                                <p class="card-text"> "
                                    <?= $review['Commentaire'] ?> "
                                </p>
                                <div class="">
                                    <p style="text-align: end;" class="card-text">
                                        <?= $review['Liked'] ?> Likes
                                    </p>

                                </div>
                            </div>

                        </div>
                        <?php
                    }


                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    if (empty($brandsReviews)) {
                        echo '<h3 class="text-center">No Liked brands Reviews Yet</h3>';
                    } else
                        echo '<h3 class="text-center">Brands reviews</h3>';

                    foreach ($brandsReviews as $review) {

                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center p-1">
                                    <p style="font-weight: 900;">
                                        <img style="border: 1px solid black;" class="rounded-circle"
                                            src="/vscar/public/images/users/<?= $userController->getUserByID($review['ID_Utilisateur'])['Photo']; ?>" />

                                        <?php
                                        echo $userController->getUserByID($review['ID_Utilisateur'])['Username'];
                                        ?>

                                    </p>
                                    <div>
                                        <?php
                                        if ($review['Note'] == 4) {
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 3) {
                                            for ($i = 0; $i < 3; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 2) {
                                            for ($i = 0; $i < 2; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 1) {
                                            for ($i = 0; $i < 1; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 5) {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        if (isset($_COOKIE['userId']) && $review['ID_Utilisateur'] == $_COOKIE['userId']) {
                                            ?>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteBrandReview(<?= $review['ID_Avis']; ?>)">
                                                Delete
                                            </button>
                                            <?php
                                        }
                                        if (isset($_COOKIE['userId']) && $reviewController->IsUserLikingBrandReview($_COOKIE['userId'], $review['ID_Avis'])) {
                                            ?>
                                            <button class="btn btn-secondary btn-sm"
                                                onclick="unlikeBrandReview(<?= $review['ID_Avis']; ?>)">
                                                Unlike
                                            </button>
                                            <?php
                                        } else if (isset($_COOKIE['userId'])) {
                                            ?>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="likeBrandReview(<?= $review['ID_Avis']; ?>)">
                                                    Like
                                                </button>
                                            <?php
                                        }


                                        ?>

                                    </div>


                                </div>
                                <p class="card-text"> "
                                    <?= $review['Commentaire'] ?> "
                                </p>
                                <div class="">
                                    <p style="text-align: end;" class="card-text">
                                        <?= $review['Liked'] ?> Likes
                                    </p>

                                </div>
                            </div>

                        </div>
                        <?php
                    }


                    ?>
                </div>
            </div>

        </div>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">My Reviews</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <?php
                    if (empty($vehiculesUserReviews)) {
                        echo '<h3 class="text-center">You have no cars reviews Yet</h3>';
                    } else
                        echo '<h3 class="text-center">Cars reviews</h3>';

                    foreach ($vehiculesUserReviews as $review) {

                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center p-1">
                                    <p style="font-weight: 900;">
                                        <img style="border: 1px solid black;" class="rounded-circle"
                                            src="/vscar/public/images/users/<?= $userController->getUserByID($review['ID_Utilisateur'])['Photo']; ?>" />

                                        <?php
                                        echo $userController->getUserByID($review['ID_Utilisateur'])['Username'];
                                        ?>

                                    </p>
                                    <div>
                                        <?php
                                        if ($review['Note'] == 4) {
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 3) {
                                            for ($i = 0; $i < 3; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 2) {
                                            for ($i = 0; $i < 2; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 1) {
                                            for ($i = 0; $i < 1; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 5) {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        if (isset($_COOKIE['userId']) && $review['ID_Utilisateur'] == $_COOKIE['userId']) {
                                            ?>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                Delete
                                            </button>
                                            <?php
                                        }
                                        if (isset($_COOKIE['userId']) && $reviewController->IsUserLikingVehiculeReview($_COOKIE['userId'], $review['ID_Avis'])) {
                                            ?>
                                            <button class="btn btn-secondary btn-sm"
                                                onclick="unlikeVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                Unlike
                                            </button>
                                            <?php
                                        } else if (isset($_COOKIE['userId'])) {
                                            ?>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="likeVehiculeReview(<?= $review['ID_Avis']; ?>)">
                                                    Like
                                                </button>
                                            <?php
                                        }


                                        ?>

                                    </div>


                                </div>
                                <p class="card-text"> "
                                    <?= $review['Commentaire'] ?> "
                                </p>
                                <div class="">
                                    <p style="text-align: end;" class="card-text">
                                        <?= $review['Liked'] ?> Likes
                                    </p>

                                </div>
                            </div>

                        </div>
                        <?php
                    }


                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    if (empty($brandsUserReviews)) {
                        echo '<h3 class="text-center">No Liked brands Reviews Yet</h3>';
                    } else
                        echo '<h3 class="text-center">Brands reviews</h3>';

                    foreach ($brandsUserReviews as $review) {

                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center p-1">
                                    <p style="font-weight: 900;">
                                        <img style="border: 1px solid black;" class="rounded-circle"
                                            src="/vscar/public/images/users/<?= $userController->getUserByID($review['ID_Utilisateur'])['Photo']; ?>" />

                                        <?php
                                        echo $userController->getUserByID($review['ID_Utilisateur'])['Username'];
                                        ?>

                                    </p>
                                    <div>
                                        <?php
                                        if ($review['Note'] == 4) {
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 3) {
                                            for ($i = 0; $i < 3; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 2) {
                                            for ($i = 0; $i < 2; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 1) {
                                            for ($i = 0; $i < 1; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        } else if ($review['Note'] == 5) {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo "<i class='bx bxs-star' style='color:#e0c400';></i>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        if (isset($_COOKIE['userId']) && $review['ID_Utilisateur'] == $_COOKIE['userId']) {
                                            ?>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteBrandReview(<?= $review['ID_Avis']; ?>)">
                                                Delete
                                            </button>
                                            <?php
                                        }
                                        if (isset($_COOKIE['userId']) && $reviewController->IsUserLikingBrandReview($_COOKIE['userId'], $review['ID_Avis'])) {
                                            ?>
                                            <button class="btn btn-secondary btn-sm"
                                                onclick="unlikeBrandReview(<?= $review['ID_Avis']; ?>)">
                                                Unlike
                                            </button>
                                            <?php
                                        } else if (isset($_COOKIE['userId'])) {
                                            ?>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="likeBrandReview(<?= $review['ID_Avis']; ?>)">
                                                    Like
                                                </button>
                                            <?php
                                        }


                                        ?>

                                    </div>


                                </div>
                                <p class="card-text"> "
                                    <?= $review['Commentaire'] ?> "
                                </p>
                                <div class="">
                                    <p style="text-align: end;" class="card-text">
                                        <?= $review['Liked'] ?> Likes
                                    </p>

                                </div>
                            </div>

                        </div>
                        <?php
                    }


                    ?>
                </div>
            </div>

        </div>




        <?php
    }
}