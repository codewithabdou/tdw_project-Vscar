<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/vscar/controller/review.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_COOKIE['userId'])) {
    $reviewController = new ReviewController();
    $brandId = $_POST['brandId'] ?? null;
    $userId = $_COOKIE['userId'];
    $rating = $_POST['rate'] ?? null;
    $comment = $_POST['comment'] ?? null;
    if ($rating == null || $comment == null || $brandId == null) {
        header("Location: /vscar/brands?brandId=" . $brandId . "");
    }
    $reviewController->addBrandReview($brandId, $userId, $rating, $comment);
    // check from where the request came from
    $referer = $_SERVER['HTTP_REFERER'] ?? null;
    if ($referer != null) {
        if (strpos($referer, "Reviews") !== false) {
            header("Location: /vscar/brandReviews?brandId=" . $brandId . "");
        } else {
            header("Location: /vscar/brands?brandId=" . $brandId . "");
        }
    }
} else {
    header("Location: /vscar/");
}




