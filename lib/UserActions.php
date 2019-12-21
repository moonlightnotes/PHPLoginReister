<?php
include_once 'func.php';

$errorMsg = false; // error message
$successMsg = false; // success message

if ($ui == 'register') {
    if (isset($_POST['register'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) and strlen($_POST['password']) > 5) {
            addUser($_POST['email'], $_POST['password'], $_FILES['file']);
            $successMsg = "you are successfully registered! you can use login form to login in site :)";
        } else {
            $errorMsg = "Invalid information!";
        }
    }
} elseif ($ui == 'login') {
    if (isset($_POST['login'])) {
        if (doLogin($_POST['email'], $_POST['password'])) {
            $successMsg = "you are successfully login!";
        } else {
            $errorMsg = 'you inserted incorrect information! please retry!!';
        }
    }
}

if (isset($_GET['logout'])) {
    doLogout();
}
