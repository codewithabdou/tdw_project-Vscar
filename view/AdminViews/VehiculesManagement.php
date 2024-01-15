<?php
// vehiculesmanagement class
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");

class VehiculesManagement
{
    public function displayAdminVehicules()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminVehiculesContent();
    }

    public function displayAddNewVehiculeForm()
    {
        $marqueController = new MarqueController();
        ?>
        <div class="d-flex align-items-center justify-content-center">
            <form class="container bg-light p-4 rounded" action="/vscar/api/vehicule/addVehicule.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="Nom">Name</label>
                        <input class="form-control" type="text" name="Nom" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="marque">Brand</label>
                        <select class="form-control" name="ID_Marque" required>
                            <?php
                            $marques = $marqueController->getAllMarques();
                            foreach ($marques as $marque) {
                                ?>
                                <option value="<?= $marque["ID_Marque"]; ?>">
                                    <?= $marque["Nom"]; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="Modèle">Model</label>
                        <input value="" class="form-control" type="text" name="Modèle" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Version">Version</label>
                        <input value="" class="form-control" type="text" name="Version" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="Année">Year</label>
                        <input value="" class="form-control" type="number" name="Année" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Prix">Price</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="Prix" required>
                            <span class="input-group-text">D.A</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="type_carburant">Fuel type</label>
                        <input value="" class="form-control" type="text" name="type_carburant" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="puissance">Performance</label>
                        <input value="" class="form-control" type="text" name="puissance" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="acceleration">Acceleration</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="acceleration" required>
                            <span class="input-group-text">s</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="conso_carburant">Fuel Consumption</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="conso_carburant" required>
                            <span class="input-group-text">L/100km</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="longueur">Length</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="longueur" required>
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="largeur">Width</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="largeur" required>
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="hauteur">Height</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="hauteur" required>
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nb_places">Number of Seats</label>
                        <input value="" class="form-control" type="number" name="nb_places" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="volume_coffre">Trunk Volume</label>
                        <div class="input-group">
                            <input value="" class="form-control" type="number" name="volume_coffre" required>
                            <span class="input-group-text">L</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="moteur">Engine</label>
                        <input value="" class="form-control" type="text" name="moteur" required>
                    </div>
                </div>


                <?php
                if (isset($_SESSION['addVehicule_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['addVehicule_error'] . '</div>';
                    unset($_SESSION['addVehicule_error']);
                }
                ?>

                <button class="btn btn-primary" type="submit">Add New Vehicle</button>
            </form>
        </div>
        <?php

    }

    public function displayAdminVehiculesContent()
    {
        $vehiculeController = new VehiculeController();
        $marqueController = new MarqueController();

        $vehicules = $vehiculeController->getAllVehicules();
        $vehiculesPerPage = 5;
        $totalVehicules = count($vehicules);
        $totalPages = ceil($totalVehicules / $vehiculesPerPage);

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        $offset = ($currentPage - 1) * $vehiculesPerPage;

        $vehiculesToShow = array_slice($vehicules, $offset, $vehiculesPerPage);


        ?>

        <div class="container mt-5">
            <h2>Vehicules Management</h2>
            <?php
            $this->displayAddNewVehiculeForm();
            ?>

            <div class="form-group mt-5">
                <input type="text" class="form-control" id="searchVehiculeInput" placeholder="Search...">
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Modele</th>
                        <th>Version</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiculesToShow as $vehicule) {
                        ?>
                        <tr>
                            <td>
                                <?= $vehicule["ID_Véhicule"]; ?>
                            </td>
                            <td>
                                <?= $marqueController->getMarqueNameByID($vehicule["ID_Marque"]) ?>
                            </td>
                            <td>
                                <?= $vehicule["Modèle"]; ?>
                            </td>
                            <td>
                                <?= $vehicule["Version"]; ?>
                            </td>
                            <td>
                                <?= $vehicule["Année"]; ?>
                            </td>
                            <td class="d-flex pl-3  ">
                                <a href="/vscar/admin/vehicules?vehiculeId=<?= $vehicule["ID_Véhicule"]; ?>"
                                    class="btn btn-primary mr-3 ">View
                                    details</a>
                                <a href="/vscar/admin/brands?brandId=<?= $vehicule["ID_Marque"]; ?>"
                                    class="btn btn-warning mr-3 ">View brand
                                    details</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <ul class="pagination justify-content-end">
                <li class="page-item <?= ($currentPage == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>
                </li>
            </ul>



            <?php



    }
    public function displayAdminVehicule($vehiculeID)
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminVehiculeContent($vehiculeID);
    }

    public function displayAdminBrand($brandId)
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminBrandContent($brandId);
    }

    public function displayAdminBrandContent($brandId)
    {
        $marqueController = new MarqueController();
        $vehiculeController = new VehiculeController();
        $brandData = $marqueController->getMarqueById($brandId);
        $vehicules = $vehiculeController->getVehiculesByBrandId($brandId);
        ?>
            <div class="container mt-5">
                <h2>Brand Management</h2>
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <form class="container bg-light p-4 rounded" action="/vscar/api/brand/updateBrand.php" method="POST">
                            <input hidden value="<?= $brandData['ID_Marque']; ?>" name="ID_Marque">

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label" for="Nom">Name</label>
                                <input value="<?= $brandData['Nom']; ?>" class="form-control" type="text" name="Nom" required>
                            </div>

                            <!-- Country -->
                            <div class="mb-3">
                                <label class="form-label" for="Pays_d_origine">Country</label>
                                <input value="<?= $brandData['Pays_d_origine']; ?>" class="form-control" type="text"
                                    name="Pays_d_origine" required>
                            </div>

                            <!-- Foundation Year -->
                            <div class="mb-3">
                                <label class="form-label" for="Année_de_création">Foundation Year</label>
                                <input value="<?= $brandData['Année_de_création']; ?>" class="form-control" type="number"
                                    name="Année_de_création" required>
                            </div>

                            <!-- Headquarters -->
                            <div class="mb-3">
                                <label class="form-label" for="Siège_social">Headquarters</label>
                                <input value="<?= $brandData['Siège_social']; ?>" class="form-control" type="text"
                                    name="Siège_social" required>
                            </div>

                            <?php
                            if (isset($_SESSION['updateBrand_error'])) {
                                echo '<div class="text-danger">' . $_SESSION['updateBrand_error'] . '</div>';
                                unset($_SESSION['updateBrand_error']);
                            }
                            ?>

                            <!-- Change the button text to reflect the action -->
                            <button class="btn btn-primary" type="submit">Update Brand</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h3>Vehicules</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Model</th>
                                    <th>Version</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($vehicules as $vehicule) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $vehicule["ID_Véhicule"]; ?>
                                        </td>
                                        <td>
                                            <?= $vehicule["Modèle"]; ?>
                                        </td>
                                        <td>
                                            <?= $vehicule["Version"]; ?>
                                        </td>
                                        <td>
                                            <?= $vehicule["Année"]; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
    }

    public function displayAdminVehiculeContent($vehiculeId)
    {
        $vehiculeController = new VehiculeController();
        $vehiculeData = $vehiculeController->getVehiculeById($vehiculeId);
        $marqueController = new MarqueController();


        if (session_status() == PHP_SESSION_NONE) {
            // Start the session if it's not already started
            session_start();
        }
        if (isset($_SESSION['updateVehicule_form_data'])) {
            $formData = $_SESSION['updateVehicule_form_data'];
            unset($_SESSION['updateVehicule_form_data']);
        } else {
            $formData = array();
        }
        ?>
                    <div class="d-flex align-items-center justify-content-center">
                        <form class="container bg-light p-4 rounded" action="/vscar/api/vehicule/updateVehicule.php"
                            method="POST">
                            <input hidden value="<?php echo $vehiculeData['ID_Véhicule']; ?>" name="ID_Véhicule">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="Nom">Name</label>
                                    <input value="<?php echo $vehiculeData['Nom']; ?>" class="form-control" type="text"
                                        name="Nom" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="marque">Brand</label>
                                    <input
                                        value="<?php echo $marqueController->getMarqueNameByID($vehiculeData["ID_Marque"]); ?>"
                                        class="form-control" type="text" readonly name="marque" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="Modèle">Model</label>
                                    <input value="<?php echo $vehiculeData['Modèle']; ?>" readonly class="form-control"
                                        type="text" name="Modèle" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="Version">Version</label>
                                    <input value="<?php echo $vehiculeData['Version']; ?>" readonly class="form-control"
                                        type="text" name="Version" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="Année">Year</label>
                                    <input value="<?php echo $vehiculeData['Année']; ?>" readonly class="form-control"
                                        type="number" name="Année" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="Prix">Price</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['Prix']; ?>" class="form-control" type="number"
                                            name="Prix" required>
                                        <span class="input-group-text">D.A</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="type_carburant">Fuel type</label>
                                    <input value="<?php echo $vehiculeData['type_carburant']; ?>" class="form-control"
                                        type="text" name="type_carburant" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="puissance">Performance</label>
                                    <input value="<?php echo $vehiculeData['puissance']; ?>" class="form-control" type="text"
                                        name="puissance" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="acceleration">Acceleration</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['acceleration']; ?>" class="form-control"
                                            type="number" name="acceleration" required>
                                        <span class="input-group-text">s</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="conso_carburant">Fuel Consumption</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['conso_carburant']; ?>" class="form-control"
                                            type="number" name="conso_carburant" required>
                                        <span class="input-group-text">L/100km</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="longueur">Length</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['longueur']; ?>" class="form-control"
                                            type="number" name="longueur" required>
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="largeur">Width</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['largeur']; ?>" class="form-control"
                                            type="number" name="largeur" required>
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="hauteur">Height</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['hauteur']; ?>" class="form-control"
                                            type="number" name="hauteur" required>
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nb_places">Number of Seats</label>
                                    <input value="<?php echo $vehiculeData['nb_places']; ?>" class="form-control" type="number"
                                        name="nb_places" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="volume_coffre">Trunk Volume</label>
                                    <div class="input-group">
                                        <input value="<?php echo $vehiculeData['volume_coffre']; ?>" class="form-control"
                                            type="number" name="volume_coffre" required>
                                        <span class="input-group-text">L</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="moteur">Engine</label>
                                    <input value="<?php echo $vehiculeData['moteur']; ?>" class="form-control" type="text"
                                        name="moteur" required>
                                </div>
                            </div>

                            <?php
                            if (isset($_SESSION['updateVehicule_error'])) {
                                echo '<div class="text-danger">' . $_SESSION['updateVehicule_error'] . '</div>';
                                unset($_SESSION['updateVehicule_error']);
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                    </div>
                    <?php
    }
}