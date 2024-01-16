<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/model/Contact.php");

class ContactController
{
    public function getAllContacts()
    {
        $contactModel = new ContactModel();
        $contacts = $contactModel->getAllContacts();
        return $contacts;
    }

    public function addContact($sender, $email, $subject, $message)
    {
        $contactModel = new ContactModel();
        try {
            $contactModel->addContact($sender, $email, $subject, $message);
            header("Location: /vscar/contact");
        } catch (\Throwable $th) {
            throw new ErrorException($th->getMessage());
        }
    }

    public function deleteContact($id)
    {
        $contactModel = new ContactModel();
        $contactModel->deleteContact($id);
    }
}