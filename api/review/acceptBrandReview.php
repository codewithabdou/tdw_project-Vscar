<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/review.php");

$reviewID = $_POST['id'] ?? null;

if (!$reviewID) {
    header("Location: /vscar/admin/review/brands");
    exit;
}

$reviewController = new ReviewController();

$reviewController->validateBrandReview($reviewID);


