<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Marque.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class BrandsView
{
    public function displayBrandsPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayBrands();
        $home->displayFooter();
    }
    public function displayBrands()
    {
        $brandsController = new MarqueController();
        $brands = $brandsController->getAllMarques();
        ?>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="title">Discover all Brands </h2>
                </div>
            </div>
            <div class="flex-centered flex-wrap gap-3">
                <?php
                foreach ($brands as $brand) {
                    ?>
                    <a href="/vscar/brands?brandId=<?= $brand['ID_Marque']; ?>" style="width: 30%;" class="card p-2 mb-4 ">
                        <img src="/vscar/public/images/brands/<?= $brand['Photo']; ?>" style="object-fit: contain;"
                            class="card-img-top" alt="News Image" height="200">
                        <div class="card-body">
                            <h5 style="font-weight: bold; font-size: 3rem;" class="text-center">
                                <?= $brand['Nom']; ?>
                            </h5>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>

        </div>
        <?php
    }
}