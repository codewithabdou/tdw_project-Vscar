<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/Database.php");


class ReviewModel
{



    public function getVehiculesReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();


        $stmt = $conn->prepare("SELECT * FROM avis_véhicules");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getBrandsReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getAllReviews()
    {
        $vehiculesReviews = $this->getVehiculesReviews();
        $brandsReviews = $this->getBrandsReviews();
        $allReviews = array();
        foreach ($vehiculesReviews as $vehiculeReview) {
            array_push($allReviews, $vehiculeReview);
        }
        foreach ($brandsReviews as $brandReview) {
            array_push($allReviews, $brandReview);
        }
        return $allReviews;

    }

    public function validateVehiculeReview($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("UPDATE avis_véhicules SET Statut= 'Validated' WHERE ID_Avis = $reviewId");
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function validateBrandReview($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("UPDATE avis_marques SET Statut= 'Validated' WHERE ID_Avis = $reviewId");
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function deleteVehiculeReview($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("DELETE FROM avis_véhicules WHERE ID_Avis = $reviewId");
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function deleteBrandReview($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("DELETE FROM avis_marques WHERE ID_Avis = $reviewId");
        try {
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function getVehiculeReviewByID($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_véhicules WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getBrandReviewByID($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_marques WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculeReviewByVehiculeID($vehiculeId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules WHERE ID_Véhicule = $vehiculeId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }


    public function getBrandReviewByBrandID($brandId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques WHERE ID_Marque = $brandId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }


    public function getValidatedVehiculeReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_véhicules WHERE Statut = 'Validated'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getValidatedBrandReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_marques WHERE Statut = 'Validated'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getPendingVehiculeReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_véhicules WHERE Statut = 'Pending'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getPendingBrandReviews()
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_marques WHERE Statut = 'Pending'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getAllValidatedReviews()
    {
        $vehiculesReviews = $this->getValidatedVehiculeReviews();
        $brandsReviews = $this->getValidatedBrandReviews();
        $allReviews = array();
        foreach ($vehiculesReviews as $vehiculeReview) {
            array_push($allReviews, $vehiculeReview);
        }
        foreach ($brandsReviews as $brandReview) {
            array_push($allReviews, $brandReview);
        }
        return $allReviews;
    }

    public function getAllPendingReviews()
    {
        $vehiculesReviews = $this->getPendingVehiculeReviews();
        $brandsReviews = $this->getPendingBrandReviews();
        $allReviews = array();
        foreach ($vehiculesReviews as $vehiculeReview) {
            array_push($allReviews, $vehiculeReview);
        }
        foreach ($brandsReviews as $brandReview) {
            array_push($allReviews, $brandReview);
        }
        return $allReviews;
    }

    public function addVehiculeReview($vehiculeId, $userId, $rating, $comment)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "INSERT INTO avis_véhicules (ID_Véhicule,ID_Utilisateur,Note,Commentaire) VALUES ($vehiculeId,$userId,$rating,'$comment')";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getReviewsOfVehicule($vehiculeId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules WHERE ID_Véhicule = $vehiculeId AND Statut = 'Validated'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getReviewsOfBrand($brandId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques WHERE ID_Marque = $brandId AND Statut = 'Validated'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getBrandsReviewsOfUser($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques WHERE ID_Utilisateur = $userId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculesReviewsOfUser($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules WHERE ID_Utilisateur = $userId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getUserReviewsOnVehicule($userId, $vehiculeId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules WHERE ID_Utilisateur = $userId AND ID_Véhicule = $vehiculeId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getUserReviewsOnBrand($userId, $brandId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques WHERE ID_Utilisateur = $userId AND ID_Marque = $brandId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function addBrandReview($brandId, $userId, $rating, $comment)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "INSERT INTO avis_marques (ID_Marque,ID_Utilisateur,Note,Commentaire) VALUES ($brandId,$userId,$rating,'$comment')";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function likeVehiculeReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("INSERT INTO avis_véhicules_aimer (ID_Utilisateur,ID_Avis) VALUES ($userId,$reviewId)");
        try {
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE avis_véhicules SET Liked = Liked + 1 WHERE ID_Avis = $reviewId");
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }

    }

    public function deleteLikeVehiculeReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM avis_véhicules_aimer WHERE ID_Utilisateur = $userId AND ID_Avis = $reviewId");
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE avis_véhicules SET Liked = Liked - 1 WHERE ID_Avis = $reviewId");
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
        return true;
    }

    public function likeBrandReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO avis_marques_aimer (ID_Utilisateur,ID_Avis) VALUES ($userId,$reviewId)");
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE avis_marques SET Liked = Liked + 1 WHERE ID_Avis = $reviewId");
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function deleteLikeBrandReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM avis_marques_aimer WHERE ID_Utilisateur = $userId AND ID_Avis = $reviewId");
            $stmt->execute();
            $stmt = $conn->prepare("UPDATE avis_marques SET Liked = Liked - 1 WHERE ID_Avis = $reviewId");
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw new ErrorException($stmt->queryString);
        } finally {
            $databaseController->disconnect($conn);
        }
    }

    public function getBrandReviewByUserId($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_marques WHERE ID_Utilisateur = $userId AND Statut = 'Validated'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculeReviewByUserId($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_véhicules WHERE ID_Utilisateur = $userId AND Statut = 'Validated'";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculeReviewLikes($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_véhicules_aimer WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getBrandReviewLikes($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT * FROM avis_marques_aimer WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculeReviewLikesCount($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT COUNT(*) FROM avis_véhicules_aimer WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getBrandReviewLikesCount($reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $sql = "SELECT COUNT(*) FROM avis_marques_aimer WHERE ID_Avis = $reviewId";
        $result = $conn->query($sql);
        $databaseController->disconnect($conn);
        return $result;
    }

    public function IsUserLikingVehiculeReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules_aimer WHERE ID_Utilisateur = $userId AND ID_Avis = $reviewId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getMostThreeLikedVehiculesReviews($idVehicule)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_véhicules WHERE ID_Véhicule = $idVehicule AND Statut = 'Validated'  ORDER BY Liked DESC LIMIT 3");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getMostThreeLikedBrandsReviews($idBrand)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques WHERE ID_Marque = $idBrand AND Statut = 'Validated' ORDER BY Liked DESC LIMIT 3");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function IsUserLikingBrandReview($userId, $reviewId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT * FROM avis_marques_aimer WHERE ID_Utilisateur = $userId AND ID_Avis = $reviewId");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getVehiculesReviewsLikedByUser($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT avis_véhicules.* FROM avis_véhicules INNER JOIN avis_véhicules_aimer ON avis_véhicules.ID_Avis = avis_véhicules_aimer.ID_Avis WHERE avis_véhicules_aimer.ID_Utilisateur = $userId AND avis_véhicules.Statut = 'Validated'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;

    }

    public function getBrandsReviewsLikedByUser($userId)
    {
        $databaseController = new DataBaseController();
        $conn = $databaseController->connect();
        $stmt = $conn->prepare("SELECT avis_marques.* FROM avis_marques INNER JOIN avis_marques_aimer ON avis_marques.ID_Avis = avis_marques_aimer.ID_Avis WHERE avis_marques_aimer.ID_Utilisateur = $userId AND avis_marques.Statut = 'Validated'");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $databaseController->disconnect($conn);
        return $result;
    }

    public function getAllReviewsLikedByUser($userId)
    {
        $vehiculesReviews = $this->getVehiculesReviewsLikedByUser($userId);
        $brandsReviews = $this->getBrandsReviewsLikedByUser($userId);
        $allReviews = array();
        foreach ($vehiculesReviews as $vehiculeReview) {
            array_push($allReviews, $vehiculeReview);
        }
        foreach ($brandsReviews as $brandReview) {
            array_push($allReviews, $brandReview);
        }
        return $allReviews;
    }

}