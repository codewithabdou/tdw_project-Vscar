<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Marque.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['ImageBrand']) && $_FILES['ImageBrand']['error'] == UPLOAD_ERR_OK) {
        $marqueController = new MarqueController();
        $Nom = $_POST['Nom'];
        $Pays = $_POST['Pays_d_origine'];
        $Année_de_création = $_POST['Année_de_création'];
        $Siège_social = $_POST['Siège_social'];

        // Access the file details
        $imageFileName = $_FILES['ImageBrand']['name'];
        $imageTempName = $_FILES['ImageBrand']['tmp_name'];

        echo $imageFileName;
        echo $imageTempName;

        // Proceed with the file handling and news addition
        $marqueController->addMarque($Nom, $Pays, $Année_de_création, $Siège_social);
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['createBrand_error'] = "No file uploaded";
        header('Location: /vscar/admin/vehicules');
    }
} else {
    header('Location: /vscar/admin/vehicules');
}