<?php

session_start();

if (isset($_SESSION['account']['id'])) {
    header('Location: /');
    die();
}

if (isset($_SESSION['tmp']['login']['error'])) {
    echo '<span class="loginForm-errorLine">', $_SESSION['tmp']['login']['error'], '</span>';
}
?>

<form action="clientScripts/script_login.php" method="POST" class="loginForm">
    <span class="loginForm-inputLine"><input type="text" name="login" placeholder="Login" /></span>
    <span class="loginForm-inputLine"><input type="password" name="password" placeholder="Password" /></span>
    <input type="submit" value="Sing In" class="loginForm-submitButton" />
</form>

<a href="registration" class="loginForm-wayToRegistrationButton">Sign Up</a>
<a href="/" class="loginForm-wayToMainPageButton">Back</a>

<?php

unset($_SESSION['tmp']['login']['error']);
