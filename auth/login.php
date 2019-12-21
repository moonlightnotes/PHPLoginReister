<?php
$ui = 'login';
include_once '../lib/UserActions.php';
?>
<h2>login to site</h2>
<div class="auth">
    <form action="<?php echo UG_HOME_URL ?>login.php" method="post">
        <div>
            <input type="text" name="email" placeholder="Your Email">
        </div>
        <div>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div>
            <input type="submit" name="login" value="login">
        </div>
    </form>
</div>
<ul>
    <li>
        <a href="<?php echo UG_HOME_URL?>">Home</a>
    </li>
</ul>
