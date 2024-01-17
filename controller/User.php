<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/model/User.php");


class UserController
{
    public function login($username, $password)
    {
        $userModel = new UserModel();
        try {
            $user = $userModel->login($username, $password);
            setcookie('loggedIn', 'true', time() + (86400 * 30), "/");
            setcookie('userId', $user["ID_Utilisateur"], time() + (86400 * 30), "/");
            setcookie('userType', $user["Type"], time() + (86400 * 30), "/");
            if ($user["Type"] === "Admin")
                header("Location: /vscar/admin/dashboard");
            else {
                header("Location: /vscar");
            }
            exit;
        } catch (\Throwable $th) {
            $_SESSION['login_error'] = $th->getMessage();
            header("Location: /vscar/login");
        }
    }

    public function logout()
    {
        unset($_COOKIE['loggedIn']);
        unset($_COOKIE['userId']);
        unset($_COOKIE['userType']);
        setcookie('loggedIn', null, -1, '/');
        setcookie('userId', null, -1, '/');
        setcookie('userType', null, -1, '/');
        header("Location: /vscar");
    }

    public function activateUser($userID)
    {
        $userModel = new UserModel();
        try {
            $userModel->activateUser($userID);
            header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['activate_error'] = $th->getMessage();
            header("Location: /vscar/admin/dashboard");
        }
    }

    public function signup($username, $password, $confirmedPassword, $firstname, $lastname, $gender, $birthday)
    {
        $userModel = new UserModel();
        try {
            $userModel->signup($username, $password, $confirmedPassword, $firstname, $lastname, $gender, $birthday);
            header("Location: /vscar/login");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['signup_error'] = $th->getMessage();
            header("Location: /vscar/signup");
        }
    }

    public function getAllUsers()
    {
        $userModel = new UserModel();
        return $userModel->getAllUsers();
    }

    public function getUserByID($id)
    {
        $userModel = new UserModel();
        return $userModel->getUserByID($id);
    }

    public function updateUser($userId, $firstname, $lastname, $gender, $birthday, $from)
    {
        $userModel = new UserModel();
        try {
            $userModel->updateUser($userId, $firstname, $lastname, $gender, $birthday);
            if ($from == "user")
                header("Location: /vscar/userProfile?userId=$userId");
            else
                header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['updateUser_error'] = $th->getMessage();
            if ($from == "user")
                header("Location: /vscar/userProfile?userId=$userId");
            else
                header("Location: /vscar/admin/users?userId=$userId");
        }
    }

    public function updateUserProfileImage($userId)
    {
        $userModel = new UserModel();
        try {
            $userModel->updateUserProfileImage($userId);
            header("Location: /vscar/userProfile?userId=$userId");
            exit;
        } catch (\Throwable $th) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['updateUserImage_error'] = $th->getMessage();
            header("Location: /vscar/userProfile?userId=$userId");
        }
    }

    public function blockUser($userID)
    {
        $userModel = new UserModel();
        try {
            $userModel->blockUser($userID);
            header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['block_error'] = $th->getMessage();
            header("Location: /vscar/admin/dashboard");
        }
    }

    public function unblockUser($userID)
    {
        $userModel = new UserModel();
        try {
            $userModel->unblockUser($userID);
            header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['unblock_error'] = $th->getMessage();
            header("Location: /vscar/admin/dashboard");
        }
    }

    public function deactivateUser($userID)
    {
        $userModel = new UserModel();
        try {
            $userModel->deactivateUser($userID);
            header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['deactivate_error'] = $th->getMessage();
            header("Location: /vscar/admin/dashboard");
        }
    }

    public function deleteUser($userID)
    {
        $userModel = new UserModel();
        try {
            $userModel->deleteUser($userID);
            header("Location: /vscar/admin/users");
            exit;
        } catch (\Throwable $th) {
            $_SESSION['delete_error'] = $th->getMessage();
            header("Location: /vscar/admin/dashboard");
        }
    }
}