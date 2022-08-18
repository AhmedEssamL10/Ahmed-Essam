<?php
session_start();
include_once("Review.php");

if (isset($result)) {
    if ($result < 25) {
        echo $result . " point" . " We will call you later on this phone ";
        print_r($_SESSION);
        // print_r($_SESSION["phone"]);
    } else {
        echo $result . " point thanks for your servay";
    }
}
