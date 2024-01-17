<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vscar/view/UserViews/Home.php");

class LoginView
{
    public function displayLoginPage()
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
        if (isset($_SESSION['login_form_data'])) {
            $formData = $_SESSION['login_form_data'];
            unset($_SESSION['login_form_data']);
        } else {
            $formData = array();
        }
        ?>
        <div class="d-flex  align-items-center justify-content-center" style="min-height : 70vh;">
            <form class="container bg-light p-4 rounded" action="/vscar/api/auth/login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input value="<?php echo isset($formData['username']) ? $formData['username'] : ''; ?>" class="form-control"
                        type="text" name="username">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input value="<?php echo isset($formData['password']) ? $formData['password'] : ''; ?>" class="form-control"
                        type="password" name="password">
                </div>
                <?php
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['login_error'] . '</div>';
                    unset($_SESSION['login_error']);
                }
                ?>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary mr-2" type="submit">Login</button>
                    <p class="mt-3">Don't have an account? <a class="underline" href="/vscar/signup">Sign up</a></p>
                </div>
            </form>
        </div>


        <?php
    }
}