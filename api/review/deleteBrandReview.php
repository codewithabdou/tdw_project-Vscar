<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/Review.php");

$reviewID = $_POST['id'] ?? null;

if (!$reviewID) {
    header("Location: /vscar/admin/reviews/brands");
    exit;
}

$reviewController = new ReviewController();

$reviewController->deleteBrandReview($reviewID);



