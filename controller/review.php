<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/model/review.php");


class ReviewController
{

    public function getVehiculesReviews()
    {
        $reviewModel = new ReviewModel();
        $vehiculesReviews = $reviewModel->getVehiculesReviews();
        return $vehiculesReviews;
    }

    public function getBrandsReviews()
    {
        $reviewModel = new ReviewModel();
        $brandsReviews = $reviewModel->getBrandsReviews();
        return $brandsReviews;
    }

    public function getAllReviews()
    {
        $reviewModel = new ReviewModel();
        $allReviews = $reviewModel->getAllReviews();
        return $allReviews;
    }

    public function validateVehiculeReview($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->validateVehiculeReview($reviewId);
        return $result;
    }

    public function validateBrandReview($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->validateBrandReview($reviewId);
        return $result;
    }

    public function deleteVehiculeReview($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->deleteVehiculeReview($reviewId);
        return $result;
    }

    public function deleteBrandReview($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->deleteBrandReview($reviewId);
        return $result;
    }

    public function getVehiculeReviewByID($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculeReviewByID($reviewId);
        return $result;
    }

    public function getBrandReviewByID($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandReviewByID($reviewId);
        return $result;
    }

    public function getVehiculeReviewByVehiculeId($vehiculeId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculeReviewByVehiculeId($vehiculeId);
        return $result;
    }

    public function getBrandReviewByBrandId($brandId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandReviewByBrandId($brandId);
        return $result;
    }

    public function addVehiculeReview($vehiculeId, $userId, $rating, $comment)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->addVehiculeReview($vehiculeId, $userId, $rating, $comment);
        return $result;
    }

    public function addBrandReview($brandId, $userId, $rating, $comment)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->addBrandReview($brandId, $userId, $rating, $comment);
        return $result;
    }

    public function getValidatedVehiculeReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getValidatedVehiculeReviews();
        return $result;
    }

    public function getValidatedBrandReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getValidatedBrandReviews();
        return $result;
    }

    public function getPendingVehiculeReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getPendingVehiculeReviews();
        return $result;
    }

    public function getPendingBrandReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getPendingBrandReviews();
        return $result;
    }

    public function getAllPendingReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getAllPendingReviews();
        return $result;
    }

    public function getAllValidatedReviews()
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getAllValidatedReviews();
        return $result;
    }

    public function getVehiculeReviewByUserId($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculeReviewByUserId($userId);
        return $result;
    }

    public function getBrandReviewByUserId($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandReviewByUserId($userId);
        return $result;
    }

    public function likeVehiculeReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        try {
            $result = $reviewModel->likeVehiculeReview($userId, $reviewId);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function likeBrandReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->likeBrandReview($userId, $reviewId);
        return $result;
    }

    public function deleteLikeVehiculeReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->deleteLikeVehiculeReview($userId, $reviewId);
        return $result;
    }

    public function deleteLikeBrandReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->deleteLikeBrandReview($userId, $reviewId);
        return $result;
    }

    public function getVehiculeReviewLikes($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculeReviewLikes($reviewId);
        return $result;
    }

    public function getBrandReviewLikes($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandReviewLikes($reviewId);
        return $result;
    }

    public function getBrandReviewLikesCount($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandReviewLikesCount($reviewId);
        return $result;
    }

    public function getVehiculeReviewLikesCount($reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculeReviewLikesCount($reviewId);
        return $result;
    }

    public function getReviewsOfVehicule($vehiculeId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getReviewsOfVehicule($vehiculeId);
        return $result;
    }

    public function getReviewsOfBrand($brandId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getReviewsOfBrand($brandId);
        return $result;
    }

    public function getBrandsReviewsOfUser($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandsReviewsOfUser($userId);
        return $result;
    }
    public function getVehiculesReviewsOfUser($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculesReviewsOfUser($userId);
        return $result;
    }

    public function getUserReviewsOnVehicule($userId, $vehiculeId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getUserReviewsOnVehicule($userId, $vehiculeId);
        return $result;
    }

    public function getUserReviewsOnBrand($userId, $brandId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getUserReviewsOnBrand($userId, $brandId);
        return $result;
    }

    public function IsUserLikingVehiculeReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->IsUserLikingVehiculeReview($userId, $reviewId);
        return $result;
    }

    public function getMostThreeLikedVehiculesReviews($id)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getMostThreeLikedVehiculesReviews($id);
        return $result;
    }

    public function getMostThreeLikedBrandsReviews($id)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getMostThreeLikedBrandsReviews($id);
        return $result;
    }

    public function IsUserLikingBrandReview($userId, $reviewId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->IsUserLikingBrandReview($userId, $reviewId);
        return $result;
    }

    public function getVehiculesReviewsLikedByUser($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getVehiculesReviewsLikedByUser($userId);
        return $result;
    }

    public function getBrandsReviewsLikedByUser($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getBrandsReviewsLikedByUser($userId);
        return $result;
    }

    public function getAllReviewsLikedByUser($userId)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->getAllReviewsLikedByUser($userId);
        return $result;
    }



}