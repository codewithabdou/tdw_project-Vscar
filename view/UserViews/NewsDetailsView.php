<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/News.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class NewsDetailsView
{
    public function displayNewsDetailsPage($id)
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayNewsDetails($id);
        $home->displayFooter();
    }
    public function displayNewsDetails($id)
    {
        $newsController = new NewsController();
        $news = $newsController->getNewsById($id);

        ?>
        <div class="container my-3">
            <div class="jumbotron">
                <h1 class="display-4">News Details Page</h1>
                <p class="lead">Here you can know more about car's world latest news.</p>
            </div>

            <div class="row">
                <div class="col-md-6 p-3">
                    <h1 class="">
                        <?= $news["Titre"]; ?>
                    </h1>
                    <p>
                        <?= $news["Texte"]; ?>
                        Patrick Bedard did it when he raced in the Indy 500. Don Sherman exceeded the double-hundred on the
                        Bonneville Salt Flats and two times as part of our Gathering of Eagles Ultimate Top Speed Shootout back
                        in 1987. I hit 231 mph at that same event. Csaba Csere went airborne at 200-plus mph at Bonneville and
                        notched 253 mph in a Bugatti Veyron.

                        More recently, editor-in-chief Tony Quiroga, testing director Dave VanderWerp, and senior editor Ezra
                        Dyer earned their 200-mph merit badges. Still, cars that can go this fast and the places to do it safely
                        rarely come together, so traveling to the far side of 200 mph is a special lifetime event.
                        Each foray to 200 mph—where you're covering nearly the length of a football field each second—is a
                        unique sensory experience that varies greatly from car to car; it's a story you want to share. Thanks to
                        some free time with a 2023 Porsche 911 Turbo S during our recent 0-150-0-mph test, we can now welcome
                        two other editors to the C/D 200-mph club. Not surprisingly, they too have something to say about
                        it.—Rich Ceppos

                        David Beard's First 200-MPH Trip
                        As far back as I can remember, I always wanted to go 200 mph. I recall my younger years when I’d peer
                        through the windows of sports cars to get a glimpse of the highest number on the speedometer. My first
                        exposure to 200 mph came at Michigan International Speedway with 40 of the premier class NASCAR machines
                        racing through Turn 1 as I stood on the fence, just feet away from the pack. Talk about a rush. I needed
                        200 mph in my life
                    </p>
                </div>
                <div class="col-md-6 p-3 ">
                    <img src='/vscar/public/images/news/<?= $news["Image"]; ?>' class="img-fluid" alt="News Image">
                    <div class="row my-5">


                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}