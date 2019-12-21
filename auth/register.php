<?php
$ui = 'register';
include_once '../lib/UserActions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<style>
    .fields_m {
        width: 80%;
        background-color: #cccccc;
    }
</style>
<body>
<div style="height: 800px; background-color: #eeeeee">
    <h2>register in the site</h2>
    <form action="<?php echo UG_HOME_URL?>auth/register.php" enctype="multipart/form-data" method="post">
        <div class="fields_m">
            <input type="email" name="email" required placeholder="please insert your email">
        </div>
        <div class="fields_m">
            <input type="password" name="password" required placeholder="please insert your password">
        </div>
        <div class="fields_m">
            <input type="file" name="file">
        </div>
        <div class="fields_m">
            <input type="submit" name="register" value="submit">
        </div>
    </form>
</div>
</body>
</html>