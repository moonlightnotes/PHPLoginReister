<?php
session_start();
include_once 'config.php';

function cleanInput(&$input)
{
    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@<style[^>]*?>.*?</style>@siU',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );

    $output = preg_replace($search, '', $input);
    $input = $output;
    return $output;
}

function sanitize(&$input)
{
    global $db; // database instance
    if (is_array($input)) {
        foreach ($input as $var => $val) {
            $output[$var] = sanitize($val);
        }
    } else {
//         for supported version of PHP
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input = cleanInput($input);
        $output = mysqli_real_escape_string($db, $input);
    }
    $input = $output;
    return $output;
}

// Upload Image

function uploadAndSaveImage($image)
{
    $uploadDir = UG_IMAGE_UPLOAD_PATH;
    $fileName = rand(1000, 9999) . '-' . $image['name'];
    $filePath = $uploadDir . $fileName;
    $filePath = str_replace("/", "\\", $filePath); // replace \ with / in file path
    // some example of mime type & it can be customize
    $allowedTypes = array('image/png', 'image/jpg', 'image/jpeg');
    if (in_array($image['type'], $allowedTypes)) {
        if (move_uploaded_file($image['tmp_name'], $filePath)) {
            $filePath = str_replace("\\", "/", $filePath); // replace \ with / in file path
            return $fileName;
        } else {
            $errorMsg = "invalid format!";
            return false;
        }
    }
}

function getHash($str)
{
    $saltStr = 'Mahtab.Khalili';
    $hash = sha1($saltStr . md5($str . $saltStr));
    return $hash;
}

function addUser($email, $password, $file)
{
    global $db;
    list($email, $password) = array(sanitize($email), sanitize($password));
    $password = getHash($password); // hash password
    $fileName = uploadAndSaveImage($file);
    if ($fileName !== false) {
    $sql = "INSERT INTO $db->usersTable (id, email, password, file) VALUES (1, '$email','$password', '$fileName');";
    $result = $db->query($sql);
var_dump($sql);
var_dump($result);
    if ($result) {
        return true;
    }
    }else{
        return false;
    }
}

function getUser($email)
{
    global $db;
    $email = sanitize($email);
    $sql = "SELECT * FROM $db->usersTable where email='$email' limit 0,1;";
    $result = $db->query($sql);
    if ($result) {
        $user = $result->fetch_assoc();
        return $user;
    }
    return false;
}

function doLogin($email, $password)
{
    $user = getUser($email);
    if ($user and $email == $user['email'] and getHash($password) == $user['password']) {
        $_SESSION['login'] = $user['email'];
        $_SESSION['userID'] = $user['id'];
        return true;
    }
    return false;
}

function doLogout()
{
    unset($_SESSION['login'], $_SESSION['user'], $_SESSION['userID']);
    return true;
}

function isLogin()
{
    if (isset($_SESSION['login'], $_SESSION['user'], $_SESSION['userID']))
        return true;
    return false;
}