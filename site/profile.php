<?php

session_start();

if (!isset($_SESSION['account']['id'])) {
    header('Location: /login');
    die();
}

include 'clientInclude/mainPage.php';
include 'clientInclude/dataBaseConnect.php';

echo '<h1>Profile</h1>';

$sql = 'SELECT * FROM user WHERE id=' . (0 + $_SESSION['account']['id']);
$res = $mysqli->query($sql);
$thisUser = $res->fetch_assoc();

?>

<form action="script_dataEdit.php" method="POST">
    <span><input type="text" placeholder="Surname" value="<?php echo $thisUser['surname']; ?>"></span>
    <span><input type="text" placeholder="Name" value="<?php echo $thisUser['name']; ?>"></span>
    <span><input type="text" placeholder="Patronymic" value="<?php echo $thisUser['patronymic']; ?>"></span>
    <span><input type="text" placeholder="Login" value="<?php echo $thisUser['login']; ?>"></span>
    <span><input type="email" placeholder="E-mail" value="<?php echo $thisUser['email']; ?>"></span>
    <span><input type="text" placeholder="Birthday Date" value="<?php echo $thisUser['birthdayDate']; ?>"></span>
    <input type="submit">
</form>

<a href="/?logOut">Log Out</a>
<a href="/">Back</a>