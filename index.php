<?php
$ui = 'index';
include_once 'lib/UserActions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME</title>
</head>
<body>
<ul>
    <?php if (!isLogin()) { ?>
        <li>
            <a href="<?php echo UG_HOME_URL . 'auth/register.php'?>">Register</a>
        </li>
        <li>
            <a href="<?php echo UG_HOME_URL . 'auth/login.php'?>">Login</a>
        </li>
    <?php }else{ ?>
        <li>
            <a href="<?php echo UG_HOME_URL . '?logout=1'; ?>">Logout</a>
        </li>
    <?php } ?>
</ul>
</body>
</html>