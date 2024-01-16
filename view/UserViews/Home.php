<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Comparaison.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php';



class UserHomePage
{
    public function displayHomePage()
    {

        $this->displayHeader();
        $this->displaySlider();
        $this->displayMenu();
        $this->displayPageContent();
        $this->displayFooter();







    }

    public function displayPageContent()
    {
        $this->displayBrandsList();
        $this->displayComparatorsForm(null, null, null, null);
        $this->displayMostCompared();

    }

    public function displayFooter()
    {
        ?>
        <!-- Pied de page -->
        <footer class="footer bg-light">
            <nav class="navbar  navbar-expand-lg navbar-light bg-light">
                <div class="collapse d-flex justify-content-center navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100 d-flex justify-content-around">
                        <li class="nav-item active">
                            <a class="nav-link" href="/vscar/"><i class='bx bx-home'></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vscar/news"><i class='bx bx-news'></i> News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vscar/comparator"><i class='bx bx-command'></i> Comparator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vscar/brands"><i class='bx bxs-car-garage'></i> Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vscar/reviews"><i class='bx bx-comment'></i> Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vscar/guide"><i class='bx bx-purchase-tag'></i> purchase guide
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact"><i class='bx bx-mail-send'></i> Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container bg-light">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; 2024 Vscar. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }

    public function displayComparatorsForm($id1, $id2, $id3, $id4)
    {

        $marqueController = new MarqueController();
        $marques = $marqueController->getAllMarques();
        $vehiculeController = new VehiculeController();
        $vehicule1 = null;
        $vehicule2 = null;
        $vehicule3 = null;
        $vehicule4 = null;
        if ($id1 !== null) {
            $vehicule1 = $vehiculeController->getVehiculeById($id1);
        }
        if ($id2 !== null) {
            $vehicule2 = $vehiculeController->getVehiculeById($id2);
        }
        if ($id3 !== null) {
            $vehicule3 = $vehiculeController->getVehiculeById($id3);
        }
        if ($id4 !== null) {
            $vehicule4 = $vehiculeController->getVehiculeById($id4);
        }
        ?>
        <div class="container p-3">
            <h1 class="title">Let's start comparing now</h1>
            <form action="/vscar/api/comparaison/compare.php" method="POST" class="row">
                <div class="col-3">
                    <h3>Vehicle 1 infos :</h3>
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="Marque1">Brand</label>
                            <select class="form-control" name="Marque1" id="Marque1" onchange="updateModels1()">
                                <?php
                                if ($vehicule1 !== null) {
                                    echo '<option value="' . $vehicule1['ID_Marque'] . '">' . $marqueController->getMarqueNameByID($vehicule1['ID_Marque']) . '</option>';
                                    foreach ($marques as $marque) {
                                        if ($marque['ID_Marque'] !== $vehicule1['ID_Marque']) {
                                            echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option value="0">Select a brand</option>';
                                    foreach ($marques as $marque) {
                                        echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Modèle1">Model</label>
                            <select class="form-control" name="Modèle1" id="Modèle1" onchange="updateVersions1()">
                                <?php
                                if ($vehicule1 !== null) {
                                    echo '<option value="' . $vehicule1['Modèle'] . '">' . $vehicule1['Modèle'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Version1">Version</label>
                            <select class="form-control" name="Version1" id="Version1" onchange="updateYears1()">
                                <?php
                                if ($vehicule1 !== null) {
                                    echo '<option value="' . $vehicule1['Version'] . '">' . $vehicule1['Version'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Année1">Year</label>
                            <select class="form-control" name="Année1" id="Année1">
                                <?php
                                if ($vehicule1 !== null) {
                                    echo '<option value="' . $vehicule1['Année'] . '">' . $vehicule1['Année'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>


                    </div>
                </div>
                <div class="col-3">
                    <h3>Vehicle 2 infos :</h3>
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="Marque2">Brand</label>
                            <select class="form-control" name="Marque2" id="Marque2" onchange="updateModels2()">
                                <?php
                                if ($vehicule2 !== null) {
                                    echo '<option value="' . $vehicule2['ID_Marque'] . '">' . $marqueController->getMarqueNameByID($vehicule2['ID_Marque']) . '</option>';
                                    foreach ($marques as $marque) {
                                        if ($marque['ID_Marque'] !== $vehicule2['ID_Marque']) {
                                            echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option value="0">Select a brand</option>';
                                    foreach ($marques as $marque) {
                                        echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Modèle2">Model</label>
                            <select class="form-control" name="Modèle2" id="Modèle2" onchange="updateVersions2()">
                                <?php
                                if ($vehicule2 !== null) {
                                    echo '<option value="' . $vehicule2['Modèle'] . '">' . $vehicule2['Modèle'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Version2">Version</label>
                            <select class="form-control" name="Version2" id="Version2" onchange="updateYears2()">
                                <?php
                                if ($vehicule2 !== null) {
                                    echo '<option value="' . $vehicule2['Version'] . '">' . $vehicule2['Version'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Année2">Year</label>
                            <select class="form-control" name="Année2" id="Année2">
                                <?php
                                if ($vehicule2 !== null) {
                                    echo '<option value="' . $vehicule2['Année'] . '">' . $vehicule2['Année'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>


                    </div>
                </div>
                <div class="col-3">
                    <h3>Vehicle 3 infos :</h3>
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="Marque3">Brand</label>
                            <select class="form-control" name="Marque3" id="Marque3" onchange="updateModels3()">
                                <?php
                                if ($vehicule3 !== null) {
                                    echo '<option value="' . $vehicule3['ID_Marque'] . '">' . $marqueController->getMarqueNameByID($vehicule3['ID_Marque']) . '</option>';
                                    foreach ($marques as $marque) {
                                        if ($marque['ID_Marque'] !== $vehicule3['ID_Marque']) {
                                            echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option value="0">Select a brand</option>';
                                    foreach ($marques as $marque) {
                                        echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Modèle3">Model</label>
                            <select class="form-control" name="Modèle3" id="Modèle3" onchange="updateVersions3()">
                                <?php
                                if ($vehicule3 !== null) {
                                    echo '<option value="' . $vehicule3['Modèle'] . '">' . $vehicule3['Modèle'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Version3">Version</label>
                            <select class="form-control" name="Version3" id="Version3" onchange="updateYears3()">
                                <?php
                                if ($vehicule3 !== null) {
                                    echo '<option value="' . $vehicule3['Version'] . '">' . $vehicule3['Version'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Année3">Year</label>
                            <select class="form-control" name="Année3" id="Année3">
                                <?php
                                if ($vehicule3 !== null) {
                                    echo '<option value="' . $vehicule3['Année'] . '">' . $vehicule3['Année'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                    </div>
                </div>
                <div class="col-3">
                    <h3>Vehicle 4 infos :</h3>
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="Marque4">Brand</label>
                            <select class="form-control" name="Marque4" id="Marque4" onchange="updateModels4()">
                                <?php
                                if ($vehicule4 !== null) {
                                    echo '<option value="' . $vehicule4['ID_Marque'] . '">' . $marqueController->getMarqueNameByID($vehicule4['ID_Marque']) . '</option>';
                                    foreach ($marques as $marque) {
                                        if ($marque['ID_Marque'] !== $vehicule4['ID_Marque']) {
                                            echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option value="0">Select a brand</option>';
                                    foreach ($marques as $marque) {
                                        echo '<option value="' . $marque['ID_Marque'] . '">' . $marque['Nom'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Modèle4">Model</label>
                            <select class="form-control" name="Modèle4" id="Modèle4" onchange="updateVersions4()">
                                <?php
                                if ($vehicule4 !== null) {
                                    echo '<option value="' . $vehicule4['Modèle'] . '">' . $vehicule4['Modèle'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Version4">Version</label>
                            <select class="form-control" name="Version4" id="Version4" onchange="updateYears4()">
                                <?php
                                if ($vehicule4 !== null) {
                                    echo '<option value="' . $vehicule4['Version'] . '">' . $vehicule4['Version'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Année4">Year</label>
                            <select class="form-control" name="Année4" id="Année4">
                                <?php
                                if ($vehicule4 !== null) {
                                    echo '<option value="' . $vehicule4['Année'] . '">' . $vehicule4['Année'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                    </div>
                </div>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['comparaison_error'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $_SESSION['comparaison_error'];
                    echo '</div>';
                    unset($_SESSION['comparaison_error']);
                }


                ?>
                <div class="flex-centered">
                    <button class="btn btn-primary my-2" type="submit">Compare</button>
                </div>
            </form>
        </div>



        <?php


    }

    public function displayMostCompared()
    {
        $comparaisonController = new ComparaisonController();
        $mostCompared = $comparaisonController->getMostComparedCars();
        $vehiculeController = new VehiculeController();
        $vehicule1 = null;
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
                foreach ($mostCompared as $comparaison) {
                    if ($comparaison['ID_Véhicule3'] == null) {
                        $vehicule1 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule1']);
                        $vehicule2 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule2']);
                        $vehicule3 = null;
                        $vehicule4 = null;
                    } else if ($comparaison['ID_Véhicule4'] == null) {
                        $vehicule1 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule1']);
                        $vehicule2 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule2']);
                        $vehicule3 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule3']);
                        $vehicule4 = null;
                    } else {
                        $vehicule1 = $vehiculeController->getVehiculeById($comparaison['ID_Véhicule1']);
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
                        <div style="height: 25%;" class="bg-white d-flex p-3 flex-column justify-content-center align-items-center">
                            <p style="font-size: 1rem;  font-weight: bold;">
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
                                class="btn btn-secondary">View more Details</a>
                        </div>
                    </div>



                    <?php

                }
                ?>
            </div>
            <h1 class="title">Can't decide what to Buy ?</h1>
            <div class="flex-centered">

                <a href="/vscar/guide" class="btn btn-primary">Let us guide you</a>
            </div>

        </div>
        <?php

    }

    public function displayBrandsList()
    {
        $brandsController = new MarqueController();
        $brands = $brandsController->getAllMarques();
        $brandsToShow = array_slice($brands, 0, 6);
        ?>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Most Popular Brands</h2>
                </div>
            </div>
            <div class="row">
                <?php
                foreach ($brandsToShow as $brand) {
                    echo '<div class="col-2 d-flex justify-content-center align-items-center">';
                    echo '<a href="/vscar/brands?brandId=' . $brand['ID_Marque'] . '">';
                    echo '<img src="/vscar/public/images/brands/' . $brand['Photo'] . '" alt="' . $brand['Nom'] . '" class="img-fluid" style="width : 80%;">';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>

        </div>
        <?php



    }

    public function displayHeader()
    {
        ?>

        <header class="d-flex bg-light px-5 p-3 justify-content-between">
            <div>
                <img src="/vscar/public/images/logos/logo-black-no-bg.png" alt="Logo" style="height: 40px;">
            </div>
            <div>
                <a href="#" class="btn btn-outline-primary mr-2"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="btn btn-outline-info mr-2"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="btn btn-outline-info mr-2"><i class='bx bxl-twitter'></i></a>
                <a href="#" class="btn btn-outline-danger"><i class='bx bxl-youtube'></i></a>
            </div>
            <div>
                <?php

                if (isset($_COOKIE['loggedIn']) && $_COOKIE['loggedIn'] === 'true' && isset($_COOKIE['userId'])) {
                    echo '<a href="#" onclick="logout()" class="btn btn-outline-primary">Logout</a>';
                    echo '<a href="/vscar/userProfile?userId=' . $_COOKIE['userId'] . '" class="btn btn-outline-secondary mx-3">Profile</a>';
                } else {
                    // Utilisateur non connecté
                    echo '<a href="/vscar/signup/" class="btn btn-outline-primary mx-3">Sign Up</a>';

                    echo '<a href="/vscar/login/" class="btn btn-outline-primary">Login</a>';
                }
                ?>
            </div>
        </header>


        <?php

    }

    public function displaySlider()
    {
        $newsController = new NewsController();
        $newsToShowInHome = $newsController->getNewsToShowInHome();

        ?>

        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                for ($key = 0; $key < count($newsToShowInHome); $key++) {
                    if ($key === 0) {
                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 0"></button>';
                    } else {
                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $key . '" aria-label="Slide ' . ($key) . '"></button>';
                    }
                }

                ?>

            </div>
            <div style=" height: 90vh;" class="carousel-inner">

                <?php
                foreach ($newsToShowInHome as $key => $news) {
                    if ($key === 0) {
                        echo '<div style="height: 90vh;" class="carousel-item  active">';
                    } else {
                        echo '<div style="height: 90vh; " class="carousel-item">';
                    }
                    ?>
                    <img src="/vscar/public/images/news/<?= $news['Image']; ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="px-5 py-2" style="font-weight: bold; background-color : rgba(0,0,0,0.5); border-radius : 5rem;">
                            <?= $news['Titre']; ?>
                        </h5>
                        <p class="px-5 py-2" style=" background-color : rgba(0,0,0,0.5); border-radius : 5rem;">
                            <?= $news['Texte']; ?>
                            <span style="font-weight: bold;"><a target="_blank" href="<?= $news['lien']; ?>">read more
                                    ...</a></span>
                        </p>
                    </div>
                </div>

                <?php
                }


                ?>




        </div>
        </div>
        <?php
    }

    public function displayMenu()
    {
        ?>
        <nav class=" navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse d-flex justify-content-center navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-around">
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/"><i class='bx bx-home'></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/news"><i class='bx bx-news'></i> News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/comparator"><i class='bx bx-command'></i> Comparator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/brands"><i class='bx bxs-car-garage'></i> Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/reviews"><i class='bx bx-comment'></i> Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vscar/guide"><i class='bx bx-purchase-tag'></i> purchase guide
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact"><i class='bx bx-mail-send'></i> Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php

    }
}