<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/tdw_project-Vscar/app/controller/Vehicule.php');


class AdminView
{


    public function showAdminDashboard()
    {
        ?>
        <div class="listCat">
            <a href="/tdw_project-Vscar/vehicules">
                <div href="" class="lienCat">
                    <img src="" alt="image_gestion_véhicules" class="imageCat" />
                    <p>Gestion des véhicules</p>
                </div>
            </a>
            <div href="#" class="lienCat">
                <img src="" alt="image_gestion_véhicules" class="imageCat" />
                <p>Gestion des véhicules</p>
            </div>
            <div href="#" class="lienCat">
                <img src="" alt="image_gestion_véhicules" class="imageCat" />
                <p>Gestion des véhicules</p>
            </div>
            <div href="#" class="lienCat">
                <img src="" alt="image_gestion_véhicules" class="imageCat" />
                <p>Gestion des véhicules</p>
            </div>
            <div href="#" class="lienCat">
                <img src="" alt="image_gestion_véhicules" class="imageCat" />
                <p>Gestion des véhicules</p>
            </div>
        </div>
        <?php
    }

}
