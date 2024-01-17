<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/model/Ads.php");

class AdsController
{
    public function addnewAd($title, $text, $link)
    {
        $adsModel = new AdsModel();
        try {
            $adsModel->addnewAd($title, $text, $link);
            header('Location: /vscar/admin/settings');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['addAd_error'] = $th->getMessage();
            header('Location: /vscar/admin/settings');
        }
    }

    public function toggleShowAd($id)
    {
        $adsModel = new AdsModel();
        try {
            $adsModel->toggleShowAd($id);
            header('Location: /vscar/admin/settings');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['toggleShowAd_error'] = $th->getMessage();
            header('Location: /vscar/admin/settings');
        }
    }

    public function getAd($id)
    {
        $adsModel = new AdsModel();
        return $adsModel->getAd($id);
    }

    public function deleteAd($id)
    {
        $adsModel = new AdsModel();
        try {
            $adsModel->deleteAd($id);
            header('Location: /vscar/admin/settings');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['deleteAd_error'] = $th->getMessage();
            header('Location: /vscar/admin/settings');
        }
    }

    public function updateAd($id, $title, $text, $link)
    {
        $adsModel = new AdsModel();
        try {
            $adsModel->updateAd($id, $title, $text, $link);
            header('Location: /vscar/admin/settings');
            return true;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateAd_error'] = $th->getMessage();
            header('Location: /vscar/admin/ads?adId' . $id);
        }
    }

    
    public function getAdsToShowInHome()
    {
        $adsModel = new AdsModel();
        return $adsModel->getAdsToShowInHome();
    }

    public function getAllAds()
    {
        $adsModel = new AdsModel();
        return $adsModel->getAllAds();
    }

}