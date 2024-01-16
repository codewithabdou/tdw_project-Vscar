<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/view/AdminViews/Home.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/PurchaseGuide.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/Contact.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/ContactInfos.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vscar/controller/News.php');

class SettingsManagement
{


    public function displayContactMessages()
    {
        $ContactController = new ContactController();
        $contacts = $ContactController->getAllContacts();
        $contactsPerPage = 5;
        $totalContacts = count($contacts);
        $totalPages = ceil($totalContacts / $contactsPerPage);

        $currentPage = isset($_GET['pageContact']) ? max(1, intval($_GET['pageContact'])) : 1;

        $offset = ($currentPage - 1) * $contactsPerPage;

        $contactsToShow = array_slice($contacts, $offset, $contactsPerPage);


        ?>

        <div class="container mt-5">
            <h2>Contacts Management</h2>

            <div class="form-group mt-5">
                <input type="text" class="form-control" id="searchNewsInput" placeholder="Search...">
            </div>

            <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="ID">ID</th>
                        <th data-sortable="true" data-field="Sender">Sender</th>
                        <th data-sortable="true" data-field="Email">Email</th>
                        <th data-sortable="true" data-field="Subject">Subject</th>
                        <th data-sortable="true" data-field="Message">Message</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($contacts as $contact) {
                        ?>
                        <tr>
                            <td>
                                <?= $contact["id"]; ?>
                            </td>
                            <td>
                                <?= $contact["sender"]; ?>
                            </td>
                            <td>
                                <?= $contact["email"]; ?>
                            </td>
                            <td>
                                <?= $contact["subject"]; ?>
                            </td>
                            <td>
                                <?= $contact["message"]; ?>
                            </td>
                            <td class="d-flex pl-3  " style="border: none;">

                                <button onclick='deleteContact(<?= $contact["id"]; ?>)' class="btn btn-danger mr-2">Delete</button>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>



            <?php

    }

    public function displayContactInfosForm()
    {
        $contactInfosController = new ContactInfosController();
        $contactInfos = $contactInfosController->getContactInfos()[0];


        // Include your update form
        ?>
            <h3 class="my-3">Contact infos Management</h3>
            <div class="d-flex align-items-center justify-content-center">
                <form class="container bg-light p-4 rounded" action="/vscar/api/contact/updateContactInfos.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="adresse">Address</label>
                            <input class="form-control" type="text" name="adresse" value="<?= $contactInfos['adresse'] ?>"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" value="<?= $contactInfos['email'] ?>"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="numéro">Phone Number</label>
                            <input class="form-control" type="text" name="numéro" value="<?= $contactInfos['numéro'] ?>"
                                required>
                        </div>
                    </div>

                    <?php
                    if (isset($_SESSION['updateContactInfos_error'])) {
                        echo '<div class="text-danger">' . $_SESSION['updateContactInfos_error'] . '</div>';
                        unset($_SESSION['updateContactInfos_error']);
                    }
                    ?>

                    <button class="btn btn-primary" type="submit">Update Conatct infos</button>
                </form>
            </div>
            <?php

    }

    public function displayNewsToHome()
    {
        $newsController = new NewsController();

        $news = $newsController->getAllNews();
        $newsPerPage = 5;
        $totalNews = count($news);
        $totalPages = ceil($totalNews / $newsPerPage);

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        $offset = ($currentPage - 1) * $newsPerPage;

        $newsToShow = array_slice($news, $offset, $newsPerPage);


        ?>

            <div class="container mt-5">
                <h2>Home news Management</h2>

                <div class="form-group mt-5">
                    <input type="text" class="form-control" id="searchNewsInput" placeholder="Search...">
                </div>

                <table data-page-size="5" data-pagination="true" data-toggle="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="ID">ID</th>
                            <th data-sortable="true" data-field="Title">Title</th>
                            <th data-sortable="true" data-field="Text">Text</th>
                            <th data-sortable="true" data-field="External link">External link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($news as $singleNews) {
                            ?>
                            <tr>
                                <td>
                                    <?= $singleNews["ID_News"]; ?>
                                </td>
                                <td>
                                    <?= $singleNews["Titre"]; ?>
                                </td>
                                <td>
                                    <?= $singleNews["Texte"]; ?>
                                </td>
                                <td>
                                    <?= $singleNews["lien"]; ?>
                                </td>
                                <td class="d-flex pl-3  " style="border: none;">

                                    <?php
                                    if ($singleNews["ShowInHome"] == 1) {
                                        ?>
                                        <button onclick='ToggleHomeNews(<?= $singleNews["ID_News"]; ?>)'
                                            class="btn btn-warning mr-2">Hide</button>
                                        <?php
                                    } else {
                                        ?>
                                        <button onclick='ToggleHomeNews(<?= $singleNews["ID_News"]; ?>)'
                                            class="btn btn-success mr-2">Show</button>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>




                <?php




    }

    public function displayGuideForm()
    {
        $purchaseGuideController = new PurchaseGuideController();
        $purchaseGuide = $purchaseGuideController->getPurchaseGuide()[0];
        ?>
                <div class="container mt-5">
                    <h2>
                        Purchase Guide Management
                    </h2>
                    <div class="row">
                        <div class=" my-3">
                            <form enctype="multipart/form-data" class="container bg-light my-3 p-4 rounded"
                                action="/vscar/api/purchase/updateGuide.php" method="POST">

                                <!-- Title -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input value="<?= $purchaseGuide['title']; ?>" class="form-control" type="text"
                                            name="title" required>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 1.95rem;">
                                        <label class="custom-file-label" for="ImagePurchase">Image</label>
                                        <input class="custom-file-input" type="file" id="ImagePurchase" name="ImagePurchase"
                                            onchange="displayCurrentImageNews(this)">
                                        <p id="currentImageDisplayNews">Current Image:
                                            <img src=<?= '/vscar/public/images/guide_achat/' . $purchaseGuide["image"] ?>
                                                style="padding: 5px;" width="40" height="40" />
                                        </p>
                                    </div>
                                </div>

                                <!-- Step 1 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle1">Step Title 1</label>
                                        <input value="<?= $purchaseGuide['stepTitle1']; ?>" class="form-control" type="text"
                                            name="stepTitle1">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph1">Step Paragraph 1</label>
                                        <textarea class="form-control"
                                            name="stepParagraph1"><?= $purchaseGuide['stepParagraph1']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle2">Step Title 2</label>
                                        <input value="<?= $purchaseGuide['stepTitle2']; ?>" class="form-control" type="text"
                                            name="stepTitle2">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph2">Step Paragraph 2</label>
                                        <textarea class="form-control"
                                            name="stepParagraph2"><?= $purchaseGuide['stepParagraph2']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle3">Step Title 3</label>
                                        <input value="<?= $purchaseGuide['stepTitle3']; ?>" class="form-control" type="text"
                                            name="stepTitle3">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph3">Step Paragraph 3</label>
                                        <textarea class="form-control"
                                            name="stepParagraph3"><?= $purchaseGuide['stepParagraph3']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle4">Step Title 4</label>
                                        <input value="<?= $purchaseGuide['stepTitle4']; ?>" class="form-control" type="text"
                                            name="stepTitle4">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph4">Step Paragraph 4</label>
                                        <textarea class="form-control"
                                            name="stepParagraph4"><?= $purchaseGuide['stepParagraph4']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 5 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle5">Step Title 5</label>
                                        <input value="<?= $purchaseGuide['stepTitle5']; ?>" class="form-control" type="text"
                                            name="stepTitle5">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph5">Step Paragraph 5</label>
                                        <textarea class="form-control"
                                            name="stepParagraph5"><?= $purchaseGuide['stepParagraph5']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 6 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle6">Step Title 6</label>
                                        <input value="<?= $purchaseGuide['stepTitle6']; ?>" class="form-control" type="text"
                                            name="stepTitle6">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph6">Step Paragraph 6</label>
                                        <textarea class="form-control"
                                            name="stepParagraph6"><?= $purchaseGuide['stepParagraph6']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 7 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle7">Step Title 7</label>
                                        <input value="<?= $purchaseGuide['stepTitle7']; ?>" class="form-control" type="text"
                                            name="stepTitle7">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph7">Step Paragraph 7</label>
                                        <textarea class="form-control"
                                            name="stepParagraph7"><?= $purchaseGuide['stepParagraph7']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Step 8 -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepTitle8">Step Title 8</label>
                                        <input value="<?= $purchaseGuide['stepTitle8']; ?>" class="form-control" type="text"
                                            name="stepTitle8">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="stepParagraph8">Step Paragraph 8</label>
                                        <textarea class="form-control"
                                            name="stepParagraph8"><?= $purchaseGuide['stepParagraph8']; ?></textarea>
                                    </div>
                                </div>



                                <?php
                                if (isset($_SESSION['updateGuide_error'])) {
                                    echo '<div class="text-danger">' . $_SESSION['updateGuide_error'] . '</div>';
                                    unset($_SESSION['updateGuide_error']);
                                }
                                ?>

                                <!-- Change the button text to reflect the action -->
                                <button class="btn btn-primary" type="submit">Update Purchase Guide</button>
                            </form>
                        </div>

                    </div>

                    <?php


    }

    public function displaySettingsManagementPage()
    {
        $adminView = new AdminHomePage();
        $adminView->displayAdminSideBar();

        $this->displayContactInfosForm();
        $this->displayContactMessages();
        $this->displayGuideForm();
        $this->displayNewsToHome();

    }
}