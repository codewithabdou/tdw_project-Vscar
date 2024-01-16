<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/DataBase.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/utils/images.php');



class UserModel
{
    public function login($username, $password)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        if ($result) {
            if ($result['Mot_de_passe'] === $password) {
                if ($result['Statut'] === 'Actif') {
                    return $result;
                } else {
                    throw new ErrorException("User is not active");
                }
            } else {
                throw new ErrorException("Invalid password");
            }
        } else {
            throw new ErrorException("Invalid username");
        }

    }

    public function activateUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("UPDATE utilisateurs SET Statut = 'Actif' WHERE ID_Utilisateur = :userID");
        $stmt->bindParam(':userID', $userID);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function deactivateUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("UPDATE utilisateurs SET Statut = 'Pending' WHERE ID_Utilisateur = :userID");
        $stmt->bindParam(':userID', $userID);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function unblockUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("UPDATE utilisateurs SET Statut = 'Actif' WHERE ID_Utilisateur = :userID");
        $stmt->bindParam(':userID', $userID);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function deleteUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE ID_Utilisateur = :userID");
        $stmt->bindParam(':userID', $userID);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function blockUser($userID)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();

        $stmt = $conn->prepare("UPDATE utilisateurs SET Statut = 'Blocked' WHERE ID_Utilisateur = :userID");
        $stmt->bindParam(':userID', $userID);
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $dbController->disconnect($conn);
        }
    }

    public function getUserByID($id)
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        return $result;
    }

    public function updateUserProfileImage($userId)
    {
        if (isset($_FILES['ImageUser']) && $_FILES['ImageUser']['error'] == UPLOAD_ERR_OK) {
            $dbController = new DataBaseController();
            $imagesTraitement = new ImagesTraitement();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("UPDATE utilisateurs SET Photo = :image WHERE ID_Utilisateur = :userId");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':image', $_FILES['ImageUser']['name']);
            try {
                $stmt->execute();
                try {
                    $imagesTraitement->uploadImage('ImageUser', '/public/images/users/');
                    return true;
                } catch (\Throwable $th) {
                    throw new ErrorException($th->getMessage());
                }
            } catch (\Throwable $th) {
                throw new ErrorException($stmt->queryString);
            } finally {
                $dbController->disconnect($conn);
            }
        } else {
            throw new ErrorException("Image not found");

        }

    }

    public function updateUser($userId, $firstname, $lastname, $gender, $birthday)
    {
        if (empty($firstname) || empty($lastname) || empty($gender) || empty($birthday)) {
            throw new ErrorException("One or more fields are empty");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE ID_utilisateur = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        if ($result === null) {
            throw new ErrorException("User doesn't exist");
        }

        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("UPDATE `utilisateurs`
        SET `Nom` = :firstname, `Prénom` = :lastname, `Sexe` = :gender, `Date_de_naissance` = :birthday
        WHERE ID_Utilisateur = :userId
        ");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $dbController->disconnect($conn);
        return true;
    }



    public function getAllUsers()
    {
        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE Type = 'Utilisateur'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $dbController->disconnect($conn);
        return $result;
    }

    public function signup($username, $password, $confirmedPassword, $firstname, $lastname, $gender, $birthday)
    {
        if (empty($username) || empty($password) || empty($confirmedPassword) || empty($firstname) || empty($lastname) || empty($gender) || empty($birthday)) {
            throw new ErrorException("One or more fields are empty");
        }

        if (strlen($password) < 8)
            throw new ErrorException("Password must be at least 8 characters long");

        if (!isset($_FILES['ImageUser']) || $_FILES['ImageUser']['error'] != UPLOAD_ERR_OK)
            throw new ErrorException("Image not found");


        $dbController = new DataBaseController();
        $conn = $dbController->connect();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbController->disconnect($conn);
        if ($result) {
            throw new ErrorException("Username already exists");
        }

        if ($password === $confirmedPassword) {
            $dbController = new DataBaseController();
            $conn = $dbController->connect();
            $stmt = $conn->prepare("INSERT INTO `utilisateurs` (`Nom`, `Prénom`, `Username`, `Mot_de_passe`, `Type`, `Sexe`, `Date_de_naissance`,`Photo`) VALUES (:firstname, :lastname, :username, :password, 'Utilisateur', :gender, :birthday,:photo)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':photo', $_FILES['ImageUser']['name']);
            try {
                $stmt->execute();
                try {
                    $imagesTraitement = new ImagesTraitement();
                    $imagesTraitement->uploadImage('ImageUser', '/public/images/users/');
                    return true;
                } catch (\Throwable $th) {
                    throw new ErrorException($th->getMessage());
                }
            } catch (\Throwable $th) {
                throw new ErrorException($th->getMessage());
            } finally {
                $dbController->disconnect($conn);
            }
        } else {
            throw new ErrorException("Passwords don't match");
        }
    }


}