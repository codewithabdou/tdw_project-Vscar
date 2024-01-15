<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Vehicule.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class ComparatorView
{
    public function displayComparatorPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $home->displayComparatorsForm(null, null, null, null);
        $this->displayComparaisonTable(null, null, null, null);
        $home->displayFooter();
    }

    public function displayComparatorPageFour($id1, $id2, $id3, $id4)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();

        $home->displayComparatorsForm($id1, $id2, $id3, $id4);
        $this->displayComparaisonTable($id1, $id2, $id3, $id4);
    }

    public function displayComparatorPageThree($id1, $id2, $id3)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();

        $home->displayComparatorsForm($id1, $id2, $id3, null);
        $this->displayComparaisonTable($id1, $id2, $id3, null);
    }

    public function displayComparatorPageTwo($id1, $id2)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();

        $home->displayComparatorsForm($id1, $id2, null, null);
        $this->displayComparaisonTable($id1, $id2, null, null);
    }

    public function displayComparaisonTable($id1, $id2, $id3, $id4)
    {
        $vehiculeController = new VehiculeController();
        if ($id1 == null || $id2 == null) {
            return;
        }
        if ($id3 == null) {
            $vehiculesToShow = array($vehiculeController->getVehiculeById($id1), $vehiculeController->getVehiculeById($id2));
        } else if ($id4 == null) {
            $vehiculesToShow = array($vehiculeController->getVehiculeById($id1), $vehiculeController->getVehiculeById($id2), $vehiculeController->getVehiculeById($id3));
        } else {
            $vehiculesToShow = array($vehiculeController->getVehiculeById($id1), $vehiculeController->getVehiculeById($id2), $vehiculeController->getVehiculeById($id3), $vehiculeController->getVehiculeById($id4));
        }
        $marqueController = new MarqueController();
        ?>
        <div class="container mt-2">
            <h2>Comparaison table</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <th>
                                <div class="flex-centered">
                                    <a href="/vscar/vehicule?vehiculeId=<?= $vehicule["ID_Véhicule"] ?>">
                                        <img src="/vscar/public/images/vehicules/<?= $vehicule["Photo"] ?>" alt="image"
                                            style="object-fit: contain;" width="200">
                                    </a>
                                </div>
                            </th>
                            <?php
                        }

                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Brand
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $marqueController->getMarqueNameByID($vehicule["ID_Marque"]) ?>
                            </td>
                            <?php
                        }
                        ?>

                    </tr>
                    <tr>
                        <td>
                            Model
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["Modèle"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Year
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["Année"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Price
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["Prix"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Fuel
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["type_carburant"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <td>
                            Horse Power
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["puissance"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Acceleration
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["acceleration"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Fuel Consumption
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["conso_carburant"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            height
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["longueur"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            width
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["largeur"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            height
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["hauteur"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Trunk Volume
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["volume_coffre"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Number of seats
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["nb_places"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            Engine
                        </td>
                        <?php
                        foreach ($vehiculesToShow as $vehicule) {
                            ?>
                            <td>
                                <?= $vehicule["moteur"] ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>

        </div>
        <?php
    }
}