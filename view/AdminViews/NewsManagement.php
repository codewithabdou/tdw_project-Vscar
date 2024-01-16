<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/News.php");

class NewsManagement
{

    public function displayAdminNews()
    {
        $home = new AdminHomePage();
        $home->displayAdminSideBar();
        $this->displayAdminNewsContent();
    }

    public function displayAddNewNewsForm()
    {
        ?>
        <div class="d-flex align-items-center justify-content-center">
            <form enctype="multipart/form-data" class="container bg-light p-4 rounded" action="/vscar/api/news/addNews.php"
                method="POST">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label" for="Titre">Title</label>
                        <input class="form-control" type="text" name="Titre" required>
                    </div>
                    <div class="col-md-4" style="margin-top: 1.95rem; ">
                        <label class="custom-file-label" for="Image"> Image</label>
                        <input class="custom-file-input" type="file" id="Image" name="Image" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="Lien">External link</label>
                        <input value="" class="form-control" type="text" name="Lien" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="Texte">Description</label>
                        <textarea value="" class="form-control" type="text" name="Texte" required rows="5"></textarea>
                    </div>
                </div>



                <?php
                if (isset($_SESSION['addNews_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['addNews_error'] . '</div>';
                    unset($_SESSION['addNews_error']);
                }
                ?>

                <button class="btn btn-primary" type="submit">Add News</button>
            </form>
        </div>
        <?php




    }



    public function displayAdminNewsUpdate($newsId)
    {
        $newsController = new NewsController();
        $existingNews = $newsController->getNewsById($newsId);
        $home = new AdminHomePage();
        $home->displayAdminSideBar();

        // Include your update form
        ?>
        <div class="d-flex align-items-center justify-content-center">
            <form enctype="multipart/form-data" class="container bg-light p-4 rounded" action="/vscar/api/news/updateNews.php"
                method="POST">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label" for="Titre">Title</label>
                        <input class="form-control" type="text" name="Titre" value="<?= $existingNews['Titre'] ?>" required>
                    </div>
                    <div class="col-md-4" style="margin-top: 1.95rem;">
                        <label class="custom-file-label" for="Image">Image</label>
                        <input class="custom-file-input" type="file" id="Image" name="Image"
                            onchange="displayCurrentImageNews(this)">
                        <p id="currentImageDisplayNews">Current Image:
                            <img src=<?= '/vscar/public/images/news/' . $existingNews["Image"] ?> style="padding: 5px;"
                                width="40" height="40" />
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="lien">External link</label>
                        <input value="<?= $existingNews['lien'] ?>" class="form-control" type="text" name="lien" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="Texte">Description</label>
                        <textarea class="form-control" type="text" name="Texte" required
                            rows="5"><?= $existingNews['Texte'] ?></textarea>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['updateNews_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['updateNews_error'] . '</div>';
                    unset($_SESSION['updateNews_error']);
                }
                ?>
                <input type="hidden" name="ID_News" value="<?= $existingNews['ID_News'] ?>">

                <button class="btn btn-primary" type="submit">Update News</button>
            </form>
        </div>
        <?php

    }

    public function displayAdminNewsContent()
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
            <h2>News Management</h2>
            <?php
            $this->displayAddNewNewsForm();
            ?>

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
                                <a href="/vscar/admin/news?newsId=<?= $singleNews["ID_News"]; ?>"
                                    class="btn btn-primary mr-3 ">Update</a>
                                <div class="">
                                    <button onclick='deleteNews(<?= $singleNews["ID_News"]; ?>)'
                                        class="btn btn-danger ">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>




            <?php


    }

}