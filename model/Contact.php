<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/DataBase.php");

class ContactModel
{

    public function getAllContacts()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM contact");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function addContact($sender, $email, $subject, $message)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("INSERT INTO contact (sender,email,subject,message) VALUES (:sender,:email,:subject,:message)");
        $stmt->bindParam(':sender', $sender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function deleteContact($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("DELETE FROM contact WHERE id = :id");
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }




}