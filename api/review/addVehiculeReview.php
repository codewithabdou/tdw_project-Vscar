<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/review.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['userId'])) {
    $reviewController = new ReviewController();
    $vehiculeId = $_POST['vehiculeId'] ?? null;
    $userId = $_COOKIE['userId'];
    $rating = $_POST['rate'] ?? null;
    $comment = $_POST['comment'] ?? null;
    if ($rating == null || $comment == null) {
        header("Location: /vscar/vehicule?vehiculeId=" . $vehiculeId . "");
    }
    $reviewController->addVehiculeReview($vehiculeId, $userId, $rating, $comment);
    header("Location: /vscar/vehicule?vehiculeId=" . $vehiculeId . "");
} else {
    header("Location: /vscar/");
}




