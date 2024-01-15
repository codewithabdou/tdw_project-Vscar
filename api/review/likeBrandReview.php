<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/review.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['userId'])) {
    $reviewController = new ReviewController();
    $reviewId = $_POST['id'] ?? null;
    $userId = $_COOKIE['userId'];
    echo $reviewId;
    echo $userId;
    $reviewController->likeBrandReview($userId, $reviewId);
}





