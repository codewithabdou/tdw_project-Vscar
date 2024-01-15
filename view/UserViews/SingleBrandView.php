<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/review.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/view/UserViews/Home.php');

class SingleBrandView
{

    public function displayBrandPage($id)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayBrandDetails($id);
        $home->displayFooter();
    }

    public function displayBrandDetails($id)
    {
        $vehiculeController = new VehiculeController();
        $marqueController = new MarqueController();
        $userController = new UserController();
        $brand = $marqueController->getMarqueById($id);
        $brandVehicules = $vehiculeController->getVehiculeByMarqueID($id);
        $reviewController = new ReviewController();
        $reviews = $reviewController->getMostThreeLikedBrandsReviews($id);
        $brandsModels = $marqueController->getModelsOfMarque($id);
        ?>
        <div>
            <!-- Page Content -->
            <div class="container my-3">
                <div class="jumbotron">
                    <h1 class="display-4">Brand Details</h1>
                    <p class="lead">Explore the details of the Brand below.</p>
                </div>

                <!-- Vehicle Details Section -->
                <div class="row">
                    <div class="col-md-6 p-3 ">
                        <img src='/vscar/public/images/brands/<?= $brand["Photo"]; ?>' class="img-fluid" alt="Vehicle Image">
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <h3>Best three reviews</h3>

                                <?php
                                if (empty($reviews)) {
                                    echo '<h3 class="text-center">No Reviews Yet</h3>';
                                }
                                foreach ($reviews as $review) {

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
                            <?php
                            if (isset($_COOKIE['userId'])) {
                                ?>
                                <div class="col-lg-12">
                                    <h3>Your comment</h3>
                                    <form method="POST" action="/vscar/api/review/addBrandReview.php">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <div class="my-3">
                                            <textarea name="comment" class="form-control" id="avis" rows="3"
                                                placeholder="What do you think about this brand ..."></textarea>
                                        </div>
                                        <input type="hidden" name="brandId" value="<?= $id; ?>">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center">

                            <h2>Brand Information</h2>
                            <?php
                            if (isset($_COOKIE['userId']) && $marqueController->IsBrandLikedByUser($_COOKIE['userId'], $brand['ID_Marque'])) {
                                ?>
                                <button class="btn btn-secondary btn-sm" onclick="unlikeBrand(<?= $brand['ID_Marque']; ?>)">
                                    Unlike
                                </button>
                                <?php
                            } else if (isset($_COOKIE['userId'])) {
                                ?>
                                    <button class="btn btn-primary btn-sm" onclick="likeBrand(<?= $brand['ID_Marque']; ?>)">
                                        Like
                                    </button>
                                <?php
                            }

                            ?>

                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">Name:
                                <?= $marqueController->getMarqueNameByID($brand["ID_Marque"]); ?>
                            </li>
                            <li class="list-group-item">Original country:
                                <?= $brand['Pays_d_origine']; ?>
                            </li>
                            <li class="list-group-item">Sector:
                                <?= $brand['Siège_social']; ?>
                            </li>
                            <li class="list-group-item">Creation date:
                                <?= $brand['Année_de_création']; ?>
                            </li>
                            <li class="list-group-item">Models:
                                <?php
                                foreach ($brandsModels as $model) {
                                    echo "<span class='mr-2'>" . $model . " - </span>";
                                }
                                ?>
                            </li>
                            <li class="list-group-item">
                                <div class="dropdown">
                                    <button onclick="dropCars()" class="dropbtn">Popular cars</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <?php
                                        foreach ($brandVehicules as $vehicule) {
                                            echo "<a href='/vscar/vehicule?vehiculeId=" . $vehicule['ID_Véhicule'] . "' class='mr-2'>" . $vehicule['Nom'] . " </a>";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?php

    }


}