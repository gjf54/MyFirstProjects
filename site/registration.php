<?php
session_start();

if (isset($_SESSION['account']['id'])) {
    header('Location: /');
    die();
}

if (isset($_SESSION['tmp']['registration']['error'])) {
    echo '<span class="registrationForm-errorLine">', $_SESSION['tmp']['registration']['error'], '</span>';
}

?>

<form action="clientScripts/script_registration.php" method="POST" class="registrationForm">
    <span class="registrationForm-inputLine"><input type="text" name="name" placeholder="Name" value="<?php if (isset($_SESSION['tmp']['registration']['name'])) {
                                                                                                            echo $_SESSION['tmp']['registration']['name'];
                                                                                                        } ?>"></span>
    <span class="registrationForm-inputLine"><input type="text" name="login" placeholder="Login" value="<?php if (isset($_SESSION['tmp']['registration']['login'])) {
                                                                                                            echo $_SESSION['tmp']['registration']['login'];
                                                                                                        } ?>"></span>
    <span class="registrationForm-inputLine"><input type="password" name="passwordFirst" placeholder="Password"></span>
    <span class="registrationForm-inputLine"><input type="password" name="passwordSecond" placeholder="Repeat password"></span>
    <input type="submit" value="Sign Up" class="registrationForm-submitButton">
</form>

<a href="login" class="loginForm-wayToLoginButton">Sign In</a>
<a href="/" class="loginForm-wayToMainPageButton">Back</a>

<?php

unset($_SESSION['tmp']['registration']['error']);
