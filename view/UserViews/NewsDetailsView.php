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