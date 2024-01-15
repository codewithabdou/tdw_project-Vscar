<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");

class GuideView
{
    public function displayGuidePage()
    {
        $this->displayGuide();
    }
    public function displayGuide()
    {
        ?>
        <div>
            guide page
        </div>
        <?php
    }
}