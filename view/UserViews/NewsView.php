<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/News.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");


class NewsView
{
    public function displayNewsPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayNews();
        $home->displayFooter();
    }
    public function displayNews()
    {
        $newsController = new NewsController();
        $news = $newsController->getAllNews();
        ?>
        <div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    foreach ($news as $newsItem) {
                        ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="/vscar/public/images/news/<?= $newsItem['Image']; ?>" style="object-fit: cover;"
                                    class="card-img-top" alt="News Image" height="200">
                                <div class="card-body">
                                    <h5>
                                        <?= $newsItem['Titre']; ?>
                                    </h5>
                                    <p class="card-text">
                                        <?= $newsItem['Texte']; ?>
                                    </p>
                                    <a href="/vscar/news?newsId=<?= $newsItem['ID_News']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <!-- News Item 1 -->

                </div>
            </div>
        </div>
        <?php
    }
}