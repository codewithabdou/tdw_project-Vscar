<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class NotFoundPage
{
    public function displayNotFoundPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayNotFound();
        $home->displayFooter();
    }

    public function displayNotFound()
    {
        ?>
        <div style="min-height: 65vh;" class="container flex-centered my-3">
            <div class="jumbotron ">
                <h1 class="display-4">404 Not Found</h1>
                <p class="lead">The page you are looking for does not exist.</p>
            </div>
        </div>
        <?php
    }
}