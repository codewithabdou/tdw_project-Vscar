<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");

class ReviewsView
{
    public function displayReviewsPage()
    {
        $this->displayReviews();
    }
    public function displayReviews()
    {
        ?>
        <div>
            reviews page
        </div>
        <?php
    }
}