<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/DataBase.php');



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
            $stmt = $conn->prepare("INSERT INTO `utilisateurs` (`Nom`, `Prénom`, `Username`, `Mot_de_passe`, `Photo`, `Type`, `Sexe`, `Date_de_naissance`) VALUES (:firstname, :lastname, :username, :password, 'user.png', 'Utilisateur', :gender, :birthday)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':gender', $gender);
            $stmt->execute();
            $dbController->disconnect($conn);
            return true;
        } else {
            throw new ErrorException("Passwords don't match");
        }
    }


}