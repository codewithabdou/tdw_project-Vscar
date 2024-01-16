<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/model/ContactInfos.php");

class ContactInfosController
{
    public function getContactInfos()
    {
        $contactInfosModel = new ContactInfosModel();
        $contactInfos = $contactInfosModel->getContactInfos();
        return $contactInfos;
    }

    public function updateContactInfos($adresse, $email, $numero)
    {
        $contactInfosModel = new ContactInfosModel();
        try {
            $contactInfosModel->updateContactInfos($adresse, $email, $numero);
            header("Location: /vscar/admin/settings");
        } catch (\Throwable $th) {
            //start session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateContactInfos_error'] = $th->getMessage();
            throw new ErrorException($th->getMessage());
        }
    }
}