<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/PurchaseGuide.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $purchaseGuideController = new PurchaseGuideController();
    print_r($_POST);
    $purchaseGuideController->updatePurchaseGuide($_POST);
} else {
    header('Location: /vscar/admin/settings');
}