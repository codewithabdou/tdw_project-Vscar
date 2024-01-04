<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/AdminViews/Home.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/controller/User.php");


class UsersManagement
{
    public function displayAdminUsers()
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminUsersContent();
    }

    public function displayAdminUsersContent()
    {
        $userController = new UserController();

        $users = $userController->getAllUsers();
        $usersPerPage = 5;
        $totalUsers = count($users);
        $totalPages = ceil($totalUsers / $usersPerPage);

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        $offset = ($currentPage - 1) * $usersPerPage;

        $usersToShow = array_slice($users, $offset, $usersPerPage);

        ?>

        <div class="container mt-5">
            <h2>Users Management</h2>



            <div class="form-group">
                <input type="text" class="form-control" id="searchUserInput" placeholder="Search...">
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($usersToShow as $user) {
                        ?>
                        <tr>
                            <td>
                                <?= $user["ID_Utilisateur"]; ?>
                            </td>
                            <td>
                                <?= $user["Nom"] . " " . $user["Prénom"]; ?>
                            </td>
                            <td>
                                <?= $user["Username"]; ?>
                            </td>
                            <td>
                                <?= $user["Statut"]; ?>
                            </td>
                            <td class="d-flex pl-3  ">
                                <a href="/vscar/admin/users?userId=<?= $user["ID_Utilisateur"]; ?>"
                                    class="btn btn-primary mr-3 ">View
                                    profile</a>
                                <?php if ($user["Statut"] === "Blocked") { ?>
                                    <div class="mr-3">
                                        <button onclick='unblockUser(<?= $user["ID_Utilisateur"]; ?>)'
                                            class="btn btn-danger ">Unblock</button>
                                    </div>
                                <?php } else if ($user["Statut"] === "Actif") { ?>
                                        <div class="mr-3">
                                            <button onclick='blockUser(<?= $user["ID_Utilisateur"]; ?>)'
                                                class="btn btn-success ">Block</button>
                                        </div>
                                <?php } ?>
                                <?php if ($user["Statut"] === "Pending") { ?>
                                    <div class="mr-3">
                                        <button onclick='activateUser(<?= $user["ID_Utilisateur"]; ?>)'
                                            class="btn btn-success">Activate</button>
                                    </div>
                                <?php } ?>
                                <div class="">
                                    <button onclick='deleteUser(<?= $user["ID_Utilisateur"]; ?>)'
                                        class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <ul class="pagination justify-content-end">
                <li class="page-item <?= ($currentPage == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>
                </li>
            </ul>

        </div>
        <?php
    }

    public function displayAdminUser($userId)
    {
        $adminHome = new AdminHomePage();
        $adminHome->displayAdminSideBar();
        $this->displayAdminUserContent($userId);
    }

    public function displayAdminUserContent($userId)
    {
        $userController = new UserController();
        $userData = $userController->getUserById($userId);


        if (session_status() == PHP_SESSION_NONE) {
            // Start the session if it's not already started
            session_start();
        }
        if (isset($_SESSION['updateUser_form_data'])) {
            $formData = $_SESSION['updateUser_form_data'];
            unset($_SESSION['updateUser_form_data']);
        } else {
            $formData = array();
        }
        ?>
        <div class="d-flex align-items-center justify-content-center">
            <form class="container bg-light p-4 rounded" action="/vscar/api/user/updateUser.php" method="POST">
                <input hidden value="<?php echo $userData['ID_Utilisateur']; ?>" name="userId">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="Nom">First name</label>
                        <input value="<?php echo $userData['Nom']; ?>" class="form-control" type="text" name="Nom">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Prénom">Last name</label>
                        <input value="<?php echo $userData['Prénom']; ?>" class="form-control" type="text" name="Prénom">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="Username">Username</label>
                        <input value="<?php echo $userData['Username']; ?>" class="form-control" type="text" name="Username"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Sexe">Gender</label>
                        <select class="form-control" id="Sexe" name="Sexe">
                            <option value="Male" <?php echo ($userData['Sexe'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($userData['Sexe'] == 'Female') ? 'selected' : ''; ?>>Female
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="Date_de_naissance">Birthday</label>
                        <input value="<?php echo $userData['Date_de_naissance']; ?>" class="form-control" type="date"
                            name="Date_de_naissance">
                    </div>
                </div>
                <?php
                if (isset($_SESSION['updateUser_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['updateUser_error'] . '</div>';
                    unset($_SESSION['updateUser_error']);
                }
                ?>
                <button class="btn btn-primary" type="submit">Update Profile</button>
            </form>
        </div>
        <?php

    }

}
