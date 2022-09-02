<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mails\VerificationCode;

$title = "Verify Your Account";
$pages = ['login', 'register', 'forget'];
if ($_GET) {
    if (isset($_GET['page'])) {
        if (!in_array($_GET['page'], $pages)) {
            $title = "Verify Your Account";
            include "layouts/errors/404.php";
            die;
        }
    } else {
        include "layouts/errors/404.php";
    }
} else {
    include "layouts/errors/404.php";
}

include "layouts/header.php";
include "App/Http/Middlewares/NotVerified.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // validation on code
    $validation = new Validation;
    $validation->setInput('verification_code')->setValue($_POST['verification_code'])
        ->required()->digits(5)->exists('users', 'verification_code');
    if (empty($validation->getErrors())) {
        // no validation error
        $user = new User;
        $result = $user->setEmail($_SESSION['email'])->setVerification_code($_POST['verification_code'])
            ->checkCode();
        // print_r($result);
        if ($result->num_rows == 1) {
            if ($_GET['page'] == 'login' || $_GET['page'] == 'register') {
                $user->setEmail_verified_at(date('Y-m-d H:i:s'));
                if ($user->makeUserVerified()) {
                    // updated
                    unset($_SESSION['email']);
                    if ($_GET['page'] == 'register') {
                        $success = "<div class='alert alert-success text-center'> Correct Code , You will be redirected to login page shortly ... </div>";
                        header('refresh:2; url=login.php'); // take 3 sec to go to login pageb 
                    } else {
                        $_SESSION['user'] = $result->fetch_object();
                        header('location:index.php');
                    }
                } else {
                    $error = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
                }
            } elseif ($_GET['page'] == 'forget') {
                header('location:set_new_password.php');
                die;
            }
        } else {
            $error = "<div class='alert alert-danger text-center'> Wrong Verification Code </div>";
        }
    }
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?></h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <?= $error ?? "" ?>
                                        <?= $success ?? "" ?>
                                        <input type="number" name="verification_code" placeholder="Verification Code">
                                        <?= isset($validation) ? $validation->getMessage('verification_code') : '' // becouse the obj exists only if method post
                                        ?>
                                        <div class="button-box">
                                            <button type="submit"><span>Verify</span></button>
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
include "layouts/scripts.php";
?>