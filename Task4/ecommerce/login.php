<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Login";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //validaftion
    $validation->setInput('email')->setValue($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', "Wrong Email Or Password")->exists('users', 'email');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', "Wrong Email Or Password");
    if (empty($validation->getErrors())) {
        // no validation errors
        $user = new User;
        $result = $user->setEmail($_POST['email'])->getUserByEmail()->fetch_object();
        // print_r($result);
        // die;
        // fetch -> convert data that return from database to data type that php can use it {fetch_all() , fetch_object()}
        if (password_verify($_POST['password'], $result->password)) {

            if (!is_null($result->email_verification_at)) {
                //login
                if ($result->status == 0) {
                    $error = "<p class='text-danger font-weight-bold'> Your Account Has Been Blocked </p>";
                } else {
                    //login
                    if (isset($_POST['Remember_me'])) {
                        setcookie('user', $_POST['email'], time() + (365 * 86400), '/');
                    }
                    $_SESSION['user'] = $result; // have user data
                    header("location:index.php");
                    die;
                }
            } else {
                $_SESSION['email'] = $_POST['email'];
                header("location:check_verification_code.php?page=login");
                die;
            }
        } else {
            $error = "<p class='text-danger font-weight-bold'> Wrong Email Or Password </p>";
        }
    }
    //check email and password
    // check email verification
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Enter your email" value="<?= $validation->getOldValues('email') ?>">
                                        <?= $validation->getMessage('email') ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->getMessage('password') ?>
                                        <?= $error ?? '' ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="Remember_me">
                                                <label>Remember me</label>
                                                <a href="forget_password.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "layouts/footer.php";
include "layouts/scripts.php";
?>