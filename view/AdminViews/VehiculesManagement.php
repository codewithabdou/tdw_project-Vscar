<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Vehicule.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");

class VehiculesManagement
{
    public function displayAdminVehicules()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminBrandsContent();
    }

    public function displayAddNewBrandsForm()
    {
        ?>
        <div class="container mt-5">
            <h2>Add new brand</h2>
            <div class="row">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <form enctype="multipart/form-data" class="container bg-light p-4 rounded"
                        action="/vscar/api/brand/createBrand.php" method="POST">
                        <div class="row">

                            <!-- Name -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="Nom">Name</label>
                                <input class="form-control" type="text" name="Nom" required>
                            </div>
                            <div class="col-md-6" style="margin-top: 1.95rem; ">
                                <label class="custom-file-label" for="ImageBrand"> Image</label>
                                <input class="custom-file-input" type="file" id="ImageBrand" name="ImageBrand" required>
                            </div>
                        </div>
                        <div class="row">


                            <!-- Country -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="Pays_d_origine">Country</label>
                                <input class="form-control" type="text" name="Pays_d_origine" required>
                            </div>

                            <!-- Foundation Year -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="Année_de_création">Foundation Year</label>
                                <input class="form-control" type="date" name="Année_de_création" required>
                            </div>


                            <!-- Headquarters -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="Siège_social">Headquarters</label>
                                <input class="form-control" type="text" name="Siège_social" required>
                            </div>

                        </div>
                        <?php
                        if (isset($_SESSION['createBrand_error'])) {
                            echo '<div class="text-danger">' . $_SESSION['createBrand_error'] . '</div>';
                            unset($_SESSION['createBrand_error']);
                        }
                        ?>

                        <!-- Change the button text to reflect the action -->
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>

        <?php

    }

    public function displayAdminBrandsContent()
    {

        $marqueController = new MarqueController();

        $brands = $marqueController->getAllMarques();




        ?>

        <div class="container mt-5">
            <h2>Vehicles Management</h2>
            <?php
            $this->displayAddNewBrandsForm();
            ?>

            <div class="form-group mt-5">
                <input type="text" class="form-control" id="searchVehiculeInput" placeholder="Search...">
            </div>

            <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="ID">ID</th>
                        <th data-sortable="true" data-field="Name">Name</th>
                        <th data-sortable="true" data-field="Country">Country</th>
                        <th data-sortable="true" data-field="Foundation year">Foundation year</th>
                        <th data-sortable="true" data-field="Headquarters">Headquarters</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($brands as $brand) {
                        ?>
                        <tr>
                            <td>
                                <?= $brand["ID_Marque"]; ?>
                            </td>
                            <td>
                                <?= $brand['Nom'] ?>
                            </td>
                            <td>
                                <?= $brand["Pays_d_origine"]; ?>
                            </td>
                            <td>
                                <?= $brand["Année_de_création"]; ?>
                            </td>
                            <td>
                                <?= $brand["Siège_social"]; ?>
                            </td>
                            <td class="d-flex pl-3  ">
                                <a href="/vscar/admin/brands?brandId=<?= $brand["ID_Marque"]; ?>" class="btn btn-warning mr-3 ">View
                                    brand
                                    details</a>
                                <button class="btn btn-danger " onclick='deleteBrand(<?= $brand["ID_Marque"] ?>)'>
                                    Delete

                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>




            <?php



    }

    public function displayAddNewVehiculeForm($brandId)
    {
        $marqueController = new MarqueController();
        ?>
            <h2 class="my-2">Add new
                <?= $marqueController->getMarqueNameByID($brandId) ?> Vehicle
            </h2>
            <div class="d-flex align-items-center justify-content-center">
                <form enctype="multipart/form-data" class="container bg-light p-4 rounded"
                    action="/vscar/api/vehicule/addVehicule.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="Nom">Name</label>
                            <input class="form-control" type="text" name="Nom" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="marque">Brand</label>
                            <input class="form-control" value="<?= $marqueController->getMarqueNameByID($brandId) ?>"
                                name="marque" readonly required>
                            <input hidden value="<?= $brandId ?>" name="ID_Marque">

                        </div>
                        <div class="col-md-4" style="margin-top: 1.95rem; ">
                            <label class="custom-file-label" for="ImageCar"> Image</label>
                            <input class="custom-file-input" type="file" id="ImageCar" name="ImageCar" required>
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
                            <input value="" class="form-control" type="number" name="puissance" required>
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

    public function displayAdminVehiculesContent($brandId)
    {
        $vehiculeController = new VehiculeController();
        $marqueController = new MarqueController();

        $vehicules = $vehiculeController->getVehiculeByMarqueID($brandId);



        ?>

            <div class="container mt-5">
                <h2>
                    <?= $marqueController->getMarqueNameByID($brandId) ?> Vehicules Management
                </h2>


                <div class="form-group mt-5">
                    <input type="text" class="form-control" id="searchVehiculeInput" placeholder="Search...">
                </div>

                <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="ID">ID</th>
                            <th data-sortable="true" data-field="Brand">Brand</th>
                            <th data-sortable="true" data-field="Modele">Modele</th>
                            <th data-sortable="true" data-field="Version">Version</th>
                            <th data-sortable="true" data-field="Year">Year</th>
                            <th>Actions</th>
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
                                        class="btn btn-primary mr-3 ">Update infos</a>

                                    <button class="btn btn-danger " onclick='deleteVehicule(<?= $vehicule["ID_Véhicule"] ?>)'>
                                        Delete

                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>




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
                    <h2>
                        <?= $marqueController->getMarqueNameByID($brandId) ?> Brand Management
                    </h2>
                    <div class="row">
                        <div class=" my-5">
                            <h3>Update brand</h3>
                            <form enctype="multipart/form-data" class="container bg-light my-3 p-4 rounded"
                                action="/vscar/api/brand/updateBrand.php" method="POST">
                                <input hidden value="<?= $brandData['ID_Marque']; ?>" name="ID_Marque">

                                <!-- Name -->
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Nom">Name</label>
                                        <input value="<?= $brandData['Nom']; ?>" class="form-control" type="text" name="Nom"
                                            required>
                                    </div>

                                    <div class="col-md-6" style="margin-top: 1.95rem;">
                                        <label class="custom-file-label" for="ImageBrand">Image</label>
                                        <input class="custom-file-input" type="file" id="ImageBrand" name="ImageBrand"
                                            onchange="displayCurrentImageNews(this)">
                                        <p id="currentImageDisplayNews">Current Image:
                                            <img src=<?= '/vscar/public/images/brands/' . $brandData["Photo"] ?>
                                                style="padding: 5px;" width="40" height="40" />
                                        </p>
                                    </div>
                                </div>
                                <div class="row">


                                    <!-- Country -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Pays_d_origine">Country</label>
                                        <input value="<?= $brandData['Pays_d_origine']; ?>" class="form-control" type="text"
                                            name="Pays_d_origine" required>
                                    </div>

                                    <!-- Foundation Year -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Année_de_création">Foundation Year</label>
                                        <input value="<?= $brandData['Année_de_création']; ?>" class="form-control"
                                            type="number" name="Année_de_création" required>
                                    </div>

                                    <!-- Headquarters -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Siège_social">Headquarters</label>
                                        <input value="<?= $brandData['Siège_social']; ?>" class="form-control" type="text"
                                            name="Siège_social" required>
                                    </div>
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

                    </div>

                    <?php
                    $this->displayAdminVehiculesContent($brandId);
                    $this->displayAddNewVehiculeForm($brandId);
    }

    public function displayAdminVehiculeContent($vehiculeId)
    {
        $vehiculeController = new VehiculeController();
        $vehiculeData = $vehiculeController->getVehiculeById($vehiculeId);
        $marqueController = new MarqueController();


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['updateVehicule_form_data'])) {
            $formData = $_SESSION['updateVehicule_form_data'];
            unset($_SESSION['updateVehicule_form_data']);
        } else {
            $formData = array();
        }
        ?>
                    <div class="my-5">
                        <h3 class="my-3">Update
                            <?= $vehiculeData['Nom'] ?>
                        </h3>
                        <form class="container bg-light p-4 rounded" enctype="multipart/form-data"
                            action="/vscar/api/vehicule/updateVehicule.php" method="POST">
                            <input hidden value="<?php echo $vehiculeData['ID_Véhicule']; ?>" name="ID_Véhicule">
                            <div class="row ">
                                <div class="col-md-4">
                                    <label class="form-label" for="Nom">Name</label>
                                    <input value="<?php echo $vehiculeData['Nom']; ?>" class="form-control" type="text"
                                        name="Nom" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="marque">Brand</label>
                                    <input
                                        value="<?php echo $marqueController->getMarqueNameByID($vehiculeData["ID_Marque"]); ?>"
                                        class="form-control" type="text" readonly name="marque" required>
                                </div>
                                <div class="col-md-4" style="margin-top: 1.95rem;">
                                    <label class="custom-file-label" for="ImageCar">Image</label>
                                    <input class="custom-file-input" type="file" id="ImageCar" name="ImageCar"
                                        onchange="displayCurrentImageNews(this)">
                                    <p id="currentImageDisplayNews">Current Image:
                                        <img src=<?= '/vscar/public/images/vehicules/' . $vehiculeData["Photo"] ?>
                                            style="padding: 5px;" width="40" height="40" />
                                    </p>
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
                            <button class="btn btn-primary" type="submit">Update Vehicle</button>
                        </form>
                    </div>
                    <?php
    }
}