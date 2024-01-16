<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/model/PurchaseGuide.php');

class PurchaseGuideController
{
    public function getPurchaseGuide()
    {
        $purchaseGuideModel = new PurchaseGuideModel();
        $purchaseGuide = $purchaseGuideModel->getPurchaseGuide();
        return $purchaseGuide;
    }

    public function updatePurchaseGuide($purchaseGuide)
    {
        $purchaseGuideModel = new PurchaseGuideModel();
        try {
            $purchaseGuideModel->updatePurchaseGuide($purchaseGuide);

            header('Location: /vscar/admin/settings');
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateGuide_error'] = $th->getMessage();
            header('Location: /vscar/admin/settings');
        }
    }
}