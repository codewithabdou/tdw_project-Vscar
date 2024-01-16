<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/PurchaseGuide.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class GuideView
{
    public function displayGuidePage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayGuide();
        $home->displayFooter();
    }
    public function displayGuide()
    {
        $guideController = new PurchaseGuideController();
        $guide = $guideController->getPurchaseGuide()[0];
        ?>
        <div class="container my-3">
            <div class="jumbotron">
                <h1 class="display-4">Purchase Guide</h1>
                <p class="lead">Let us help you buy your new car.</p>
            </div>

            <div class="row">
                <div class="col-md-6 p-3">
                    <h1 class="">
                        <?= $guide["title"]; ?>
                    </h1>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $stepTitle = "stepTitle" . $i;
                        $stepParagraph = "stepParagraph" . $i;
                        if ($guide[$stepTitle] != null) {
                            ?>
                            <div class="mb-3">

                                <h5 style="font-weight: bolder;">
                                    <?= $i . ". " . $guide[$stepTitle]; ?>
                                </h5>
                                <p>
                                    <?= $guide[$stepParagraph]; ?>
                                </p>
                            </div>
                            <?php
                        }
                    }

                    ?>



                </div>
                <div class="col-md-6 p-3 ">
                    <img src='/vscar/public/images/guide_achat/<?= $guide["image"]; ?>' class="img-fluid" alt="Guide Image">
                    <div class="row my-5">


                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}