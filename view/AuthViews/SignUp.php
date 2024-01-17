<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class SignUpView
{
    public function displaySignUpPage()
    {
        $home = new UserHomePage();
        $home->displayHeader();
        $home->displayMenu();
        $this->displayForm();
        $home->displayFooter();

    }
    public function displayForm()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['signup_form_data'])) {
            $formData = $_SESSION['signup_form_data'];
            unset($_SESSION['signup_form_data']);
        } else {
            $formData = array();
        }
        ?>

        <div class="d-flex align-items-center justify-content-center" style="min-height: 90vh;">
            <form enctype="multipart/form-data" class="container bg-light p-4 rounded" action="/vscar/api/auth/signup.php"
                method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="firstname">First name</label>
                        <input value="<?php echo isset($formData['firstname']) ? $formData['firstname'] : ''; ?>"
                            class="form-control" type="text" name="firstname">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="lastname">Last name</label>
                        <input value="<?php echo isset($formData['lastname']) ? $formData['lastname'] : ''; ?>"
                            class="form-control" type="text" name="lastname">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="username">Username</label>
                        <input value="<?php echo isset($formData['username']) ? $formData['username'] : ''; ?>"
                            class="form-control" type="text" name="username">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="gender">Gender</label>
                        <select value="<?php echo isset($formData['gender']) ? $formData['gender'] : ''; ?>"
                            class="form-control" id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="birthday">Birthday</label>
                        <input value="<?php echo isset($formData['birthday']) ? $formData['birthday'] : ''; ?>"
                            class="form-control" type="date" name="birthday">
                    </div>
                    <div class="col-md-6" style="margin-top: 1.95rem;">
                        <label class="custom-file-label" for="ImageUser">Image</label>
                        <input class="custom-file-input" type="file" id="ImageUser" name="ImageUser">

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="password">Password</label>
                        <input value="<?php echo isset($formData['password']) ? $formData['password'] : ''; ?>"
                            class="form-control" type="password" name="password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="confirmedPassword">Confirm password</label>
                        <input
                            value="<?php echo isset($formData['confirmedPassword']) ? $formData['confirmedPassword'] : ''; ?>"
                            class="form-control" type="password" name="confirmedPassword">
                    </div>
                </div>
                <?php
                if (isset($_SESSION['signup_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['signup_error'] . '</div>';
                    unset($_SESSION['signup_error']);
                }
                ?>
                <button class="btn btn-primary" type="submit">Sign up</button>
            </form>
        </div>



        <?php
    }
}