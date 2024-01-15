<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/review.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/view/UserViews/Home.php');

class VehiculeView
{

    public function displayVehiculePage($id)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayVehiculeDetails($id);
        $home->displayComparatorsForm($id, null, null, null);
        $this->displayMostComparedCars($id);
        $home->displayFooter();
    }

    public function displayVehiculeDetails($id)
    {
        $vehiculeController = new VehiculeController();
        $vehicule = $vehiculeController->getVehiculeById($id);
        $marqueController = new MarqueController();
        $reviewController = new ReviewController();
        $reviews = $reviewController->getMostThreeLikedVehiculesReviews($id);
        $userController = new UserController();
        ?>
        <div>
            <!-- Page Content -->
            <div class="container mt-3">
                <div class="jumbotron">
                    <h1 class="display-4">Vehicle Details</h1>
                    <p class="lead">Explore the details of the vehicle below.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <img src='/vscar/public/images/vehicules/<?= $vehicule["Photo"]; ?>' class="img-fluid"
                            alt="Vehicle Image">
                        <div class="row mt-4">
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
                        </div>
                        <?php
                        if (isset($_COOKIE['userId'])) {
                            ?>
                            <div class="row mt-4">
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
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center">

                            <h2>Vehicle Information</h2>
                            <?php
                            if (isset($_COOKIE['userId']) && $vehiculeController->IsVehiculeLikedByUser($_COOKIE['userId'], $vehicule['ID_Véhicule'])) {
                                ?>
                                <button class="btn btn-secondary btn-sm" onclick="unlikeVehicule(<?= $vehicule['ID_Véhicule']; ?>)">
                                    Unlike
                                </button>
                                <?php
                            } else if (isset($_COOKIE['userId'])) {
                                ?>
                                    <button class="btn btn-primary btn-sm" onclick="likeVehicule(<?= $vehicule['ID_Véhicule']; ?>)">
                                        Like
                                    </button>
                                <?php
                            }

                            ?>

                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">Make:
                                <?= $marqueController->getMarqueNameByID($vehicule["ID_Marque"]); ?>
                            </li>
                            <li class="list-group-item">Model:
                                <?= $vehicule["Modèle"] ?>
                            </li>
                            <li class="list-group-item">Year:
                                <?= $vehicule["Année"] ?>
                            </li>
                            <li class="list-group-item">Price:
                                <?= $vehicule["Prix"] ?>
                            </li>
                            <li class="list-group-item">Engine:
                                <?= $vehicule["moteur"] ?>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?php

    }


    public function displayMostComparedCars($id)
    {
        $comparaisonController = new ComparaisonController();
        $mostCompared = $comparaisonController->getMostComparedCarsWithCar($id);
        $vehiculeController = new VehiculeController();
        $vehicule1 = $vehiculeController->getVehiculeById($id);
        $vehicule2 = null;
        $vehicule3 = null;
        $vehicule4 = null;
        ?>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Most Compared Cars</h2>
                </div>
            </div>
            <div class="d-flex gap-3 flex-wrap justify-content-center align-items-stretch">
                <?php
                if (empty($mostCompared)) {
                    echo '<h3 class="text-center">No Comparisons Yet</h3>';
                }
                foreach ($mostCompared as $comparaison) {
                    if ($comparaison['ID_Véhicule3'] == null) {
                        $vehicule2 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule2']);
                        $vehicule3 = null;
                        $vehicule4 = null;
                    } else if ($comparaison['ID_Véhicule4'] == null) {
                        $vehicule2 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule2']);
                        $vehicule3 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule3']);
                        $vehicule4 = null;
                    } else {
                        $vehicule2 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule2']);
                        $vehicule3 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule3']);
                        $vehicule4 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule4']);

                    }
                    ?>

                    <div class=" bg-light " style="border-radius: 2rem; border: 1px solid gray; overflow: hidden;width : 45%;">
                        <div style="height: 75%;" class="d-flex bg-light justify-content-center flex-wrap p-5 align-items-center">
                            <img src="/vscar/public/images/vehicules/<?= $vehicule1['Photo']; ?>" style="width: 30%;" alt="img1">
                            <p style="font-size: 2rem;  font-weight: bolder;">Vs.</p>
                            <img src="/vscar/public/images/vehicules/<?= $vehicule2['Photo']; ?>" width="30%" alt="img2">
                            <?php
                            if ($vehicule3 !== null) {
                                echo '<p style="font-size: 2rem; width : 2rem;  font-weight: bolder;"></p>';
                                echo '<img src="/vscar/public/images/vehicules/' . $vehicule3['Photo'] . '" width="30%" alt="img3">';
                            }

                            ?>
                            <?php
                            if ($vehicule4 !== null) {
                                echo '<p style="font-size: 2rem;  font-weight: bolder;">Vs.</p>';
                                echo '<img src="/vscar/public/images/vehicules/' . $vehicule4['Photo'] . '" width="30%" alt="img4">';
                            }

                            ?>

                        </div>
                        <div style="height: 25%;"
                            class="bg-white d-flex py-3 flex-column justify-content-center align-items-center">
                            <p class="mt-2" style="font-size: 1rem;  font-weight: bold;">
                                <?= $vehicule1['Nom'] ?> <span style="color: gray; font-size: 0.8rem;  font-weight:normal;">
                                    Vs. </span>
                                <?= $vehicule2['Nom'] ?>
                                <?php
                                if ($vehicule3 !== null) {
                                    echo '<span style="color: gray; font-size: 0.8rem;  font-weight:normal;"> Vs. </span>';
                                    echo $vehicule3['Nom'];
                                }
                                if ($vehicule4 !== null) {
                                    echo '<span style="color: gray; font-size: 0.8rem;  font-weight:normal;"> Vs. </span>';
                                    echo $vehicule4['Nom'];
                                } ?>


                            </p>
                            <a href="/vscar/comparator?id1=<?= $vehicule1['ID_Véhicule']; ?>&id2=<?= $vehicule2['ID_Véhicule']; ?>&id3=<?= $vehicule3['ID_Véhicule'] ?? null; ?>&id4=<?= $vehicule4['ID_Véhicule'] ?? null; ?>"
                                class="btn mb-2 btn-secondary">View more Details</a>
                        </div>
                    </div>



                    <?php

                }
                ?>
            </div>

        </div>
        <?php

    }


}