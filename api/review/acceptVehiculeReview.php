<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/review.php");

$reviewID = $_POST['id'] ?? null;

if (!$reviewID) {
    header("Location: /vscar/admin/reviews/vehicules");
    exit;
}

$reviewController = new ReviewController();

$reviewController->validateVehiculeReview($reviewID);


