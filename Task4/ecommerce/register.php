<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mails\VerificationCode;

$title = "Register";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //validation
    $validation->setInput("first_name")->setValue($_POST["first_name"])->required()->min(2)->max(32);
    $validation->setInput("last_name")->setValue($_POST["last_name"])->required()->min(2)->max(32);
    $validation->setInput('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users', 'phone');
    $validation->setInput('email')->setValue($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users', 'email');
    $validation->setInput('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', 'mini 8 chars , number, one uppercase letter , one lowercase letter , one specidal char')->confirmed($_POST['password_confirmation']);
    $validation->setInput('password_confirmation')->setValue($_POST['password_confirmation'])->required();
    $validation->setInput('gender')->setValue($_POST['gender'])->required()->in(['m', 'f']);
    // then check the error array if it empty then it has no validation error
    if (empty($validation->getErrors())) {
        // make verification code
        $verificationCode = rand(10000, 99999);
        $user = new User;
        // want user to take data and insert it in data base
        $user->setFirst_name($_POST["first_name"])->setLast_name($_POST["last_name"])->setEmail($_POST['email'])
            ->setPhone($_POST['phone'])->setPassword($_POST['password'])->setGender($_POST['gender'])->setVerification_code($verificationCode);
        if ($user->create()) {
            // send mail
            $verificationMail = new VerificationCode;
            $subject = "verification code";
            $body = "<p>Hello {$_POST['first_name']}</p>
            <p>Your Verification Code: <b style='color:blue;'>{$verificationCode}</b></p>
            <p>Thank You.</p>";
            if ($verificationMail->send($_POST['email'], $subject, $body)) { // if email is send
                $_SESSION['email'] = $_POST['email'];
                header('location:check_verification_code.php?page=register');
                die;
            } else {
                $error = "<div class='alert alert-danger text-center'> Please Try Again Later </div>";
            }
            // go to verification code page
            $_SESSION['email'] = $_POST['email'];
            header('location:check_verification_code.php');
            die;
        } else {
            $error = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
        }
    }
}
?>
<?php

//     $errors = [];
//     if (empty($_POST['email'])) {
//         // error 1 
//         $errors['email'] = "<div class='font-weight-bold text-danger' > Email Is Required </div>";
//     }
//     if (empty($_POST['password'])) {
//         // error 2 
//         $errors['password'] = "<div class='font-weight-bold text-danger' > Password Is Required </div>";
//     }
//     if (empty($_POST['first_name'])) {
//         // error 1 
//         $errors['first_name'] = "<div class='font-weight-bold text-danger' > Please enter your first name </div>";
//     }
//     if (empty($_POST['last_name'])) {
//         // error 2 
//         $errors['last_name'] = "<div class='font-weight-bold text-danger' > Please enter your last name </div>";
//     }
//     if (empty($errors)) {
//         // login
//         $flage = false;
//         // access database
//         header('location:index.php');
//         die;
//     }
// }
// if ($flage == false) {
//     $errors['email'] = "<div class='font-weight-bold text-danger' > please enter the correct email or password </div>";


?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="#" method="post">
                                        <input type="text" name="first_name" placeholder="First Name" value="<?= $validation->getOldValues("first_name")/* بحتفظ بالvalue*/ ?>">
                                        <?= $validation->getMessage("first_name") ?>
                                        <input type="text" name="last_name" placeholder="Last Name" value="<?= $validation->getOldValues("last_name") ?>">
                                        <?= $validation->getMessage("last_name") ?>
                                        <input type=" email" name="email" placeholder="Email Address" value="<?= $validation->getOldValues("email") ?>">
                                        <?= $validation->getMessage("email") ?>
                                        <input type=" tel" name="phone" placeholder="Phone" value="<?= $validation->getOldValues("phone") ?>">
                                        <?= $validation->getMessage("phone") ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->getMessage("password") ?>
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                        <?= $validation->getMessage("password_confirmation") ?>
                                        <select name="gender" class="form-control my-3" id="">
                                            <option <?= $validation->getOldValues("gender") == "m" ? 'selected' : '' ?> value="m">Male</option>
                                            <option <?= $validation->getOldValues("gender") == "f" ? 'selected' : '' ?> value="f">Female</option>
                                        </select>
                                        <?= $validation->getMessage("gender") ?>
                                        <div class="button-box">
                                            <button type="submit"><span>Register</span></button>
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