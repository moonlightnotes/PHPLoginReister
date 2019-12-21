<?php

define('UG_HOME_URL', 'http://phploginregister.test/'); // virtual host in local

// URL vs PATH
define('UG_IMAGE_UPLOAD_PATH', dirname(__DIR__) . '/upload/userFiles/');


// This connection is just for using of an instance of database
// database information
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = '';

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
/* check connection */
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

// define our tables for usage in code
$db->usersTable = "users";
