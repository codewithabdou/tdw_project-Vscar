<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/review.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/view/UserViews/Home.php');

class VehiculeReiewsView
{

    public function displayVehiculeReviewsPage($id)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayVehiculeDetails($id);
        $home->displayFooter();
    }



    public function displayVehiculeDetails($id)
    {
        $vehiculeController = new VehiculeController();
        $marqueController = new MarqueController();
        $userController = new UserController();
        $vehicule = $vehiculeController->getVehiculeByID($id);
        $reviewController = new ReviewController();
        $reviews = $reviewController->getReviewsOfVehicule($id);
        $reviewsPerPage = 5;
        $totalPages = ceil(count($reviews) / $reviewsPerPage);

        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;


        if ($page < 1 || $page > $totalPages) {
            $page = 1;
        }

        $reviewChunks = array_chunk($reviews, $reviewsPerPage);

        $currentPageReviews = $reviewChunks[$page - 1];

        ?>
        <div>
            <!-- Page Content -->
            <div class="container my-3">
                <div class="jumbotron">
                    <h1 class="display-4">Vehicle Reviews</h1>
                    <p class="lead">Explore the reviews of the vehicle below.</p>
                </div>

                <!-- Vehicle Details Section -->
                <div class="row">
                    <div class="col-md-6 p-3 ">
                        <img src='/vscar/public/images/vehicules/<?= $vehicule["Photo"]; ?>' class="img-fluid"
                            alt="Vehicle Image">
                        <div class="row my-5">
                            <div class="">
                                <div class="d-flex justify-content-between align-items-center">

                                    <h2>Vehicle Information</h2>
                                    <?php
                                    if (isset($_COOKIE['userId']) && $vehiculeController->IsVehiculeLikedByUser($_COOKIE['userId'], $vehicule['ID_Véhicule'])) {
                                        ?>
                                        <button class="btn btn-secondary btn-sm"
                                            onclick="unlikeVehicule(<?= $vehicule['ID_Véhicule']; ?>)">
                                            Unlike
                                        </button>
                                        <?php
                                    } else if (isset($_COOKIE['userId'])) {
                                        ?>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="likeVehicule(<?= $vehicule['ID_Véhicule']; ?>)">
                                                Like
                                            </button>
                                        <?php
                                    }

                                    ?>

                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">Name:
                                        <?= $vehicule['Nom'] ?>
                                    </li>
                                    <li class="list-group-item">Details page:
                                        <a href="/vscar/vehicule?vehiculeId=<?= $vehicule["ID_Véhicule"]; ?>">
                                            click here
                                        </a>
                                    </li>


                                </ul>
                            </div>
                            <?php
                            if (isset($_COOKIE['userId'])) {
                                ?>
                                <div class="row my-4">
                                    <div class="col-lg-12">
                                        <h3>Your comment</h3>
                                        <form method="POST" action="/vscar/api/review/addVehiculeReview.php">
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
                                                    placeholder="What do you think about this car ..."></textarea>
                                            </div>
                                            <input type="hidden" name="vehiculeId" value="<?= $id; ?>">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Vehicle reviews</h3>

                        <?php
                        if (empty($currentPageReviews)) {
                            echo '<h3 class="text-center">No Reviews Yet</h3>';
                        }
                        foreach ($currentPageReviews as $review) {

                            ?>
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class=" d-flex justify-content-between align-items-center p-1">
                                        <p style="font-weight: 900;">
                                            <img style="border: 1px solid black;" height="20" width="20" class="rounded-circle"
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

                        echo '<ul class="pagination justify-content-end">';
                        echo '<li class="page-item ' . (($page == 1) ? 'disabled' : '') . '">';
                        echo '<a class="page-link" href="/vscar/vehiculeReviews?vehiculeId=' . $id . '&page=' . ($page - 1) . '" tabindex="-1" aria-disabled="true">Previous</a>';
                        echo '</li>';

                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item ' . (($i == $page) ? 'active' : '') . '">';
                            echo '<a class="page-link" href="/vscar/vehiculeReviews?vehiculeId=' . $id . '&page=' . $i . '">' . $i . '</a>';
                            echo '</li>';
                        }

                        echo '<li class="page-item ' . (($page == $totalPages) ? 'disabled' : '') . '">';
                        echo '<a class="page-link" href="/vscar/vehiculeReviews?vehiculeId=' . $id . '&page=' . ($page + 1) . '">Next</a>';
                        echo '</li>';
                        echo '</ul>';
                        ?>

                    </div>

                </div>
            </div>
        </div>


        <?php

    }





}