<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/ContactInfos.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class ContactView
{
    public function displayContactPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayContactForm();
        $home->displayFooter();
    }
    public function displayContactForm()
    {
        $contactInfosController = new ContactInfosController();
        $contactInfos = $contactInfosController->getContactInfos()[0];
        ?>
        <!--Section: Contact v.2-->
        <section class="container">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
                directly. Our team will come back to you within
                a matter of hours to help you.</p>

            <div class="row">

                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="/vscar/api/contact/addContact.php" method="POST">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="sender" class="">Your name</label>
                                    <input required type="text" id="sender" name="sender" class="form-control mb-2">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Your email</label>
                                    <input required type="text" id="email" name="email" class="form-control mb-2">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Subject</label>
                                    <input required type="text" id="subject" name="subject" class="form-control mb-2">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="md-form">
                                    <label for="message">Your message</label>
                                    <textarea required type="text" id="message" name="message" rows="2"
                                        class="form-control mb-2 md-textarea"></textarea>
                                </div>

                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Send</button>

                    </form>

                </div>

                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="bx bx-map"></i>
                            <p>
                                <?= $contactInfos['adresse'] ?>
                            </p>
                        </li>

                        <li><i class="bx bx-phone mt-4 "></i>
                            <p>
                                <?= $contactInfos['numéro'] ?>
                            </p>
                        </li>

                        <li><i class="bx bx-envelope mt-4 f"></i>
                            <p>
                                <?= $contactInfos['email'] ?>
                            </p>
                        </li>
                    </ul>
                </div>

            </div>

        </section>
        <?php

    }
}