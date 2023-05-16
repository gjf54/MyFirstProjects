<?php

session_start();

$rexpr = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[-*+!]).{8,20}$/';

if (!preg_match($rexpr, $_POST['passwordFirst'])) {
    $_POST['error'] = 'Uncorrect password';
    $_SESSION['tmp']['registration'] = $_POST;
    header('Location: /registration');
    die();
}

$rexpr = '/^[-a-zа-яё\d ]{1,20}$/i';

if (!preg_match($rexpr, $_POST['name'])) {
    $_POST['error'] = 'Uncorrect name';
    $_SESSION['tmp']['registration'] = $_POST;
    header('Location: /registration');
    die();
}

$rexpr = '/^[-a-z\d_]{1,16}$/i';

if (!preg_match($rexpr, $_POST['name'])) {
    $_POST['error'] = 'Uncorrect login';
    $_SESSION['tmp']['registration'] = $_POST;
    header('Location: /registration');
    die();
}

if ($_POST['passwordFirst'] != $_POST['passwordSecond']) {
    $_POST['error'] = 'Check password';
    $_SESSION['tmp']['registration'] = $_POST;
    header('Location: /registration');
    die();
}

include '../clientInclude/dataBaseConnect.php';

try {
    $sql = 'INSERT INTO user (name,login,password,idRole) VALUES (?,?,?,5)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $_POST['name'], $_POST['login'], md5($_POST['passwordFirst']));
    $stmt->execute();
    $_SESSION['tmp']['account'] = $_POST;
    $stmt->close();
    header('Location: /');
    die();
} catch (Exception $e) {
    // echo $e;
    $rexpr = '/login_Unique/i';
    if (preg_match($rexpr, $e)) {
        $stmt->close();
        $_POST['error'] = 'Login is already exist';
        $_SESSION['tmp']['registration'] = $_POST;
        header('Location: /registration');
        die();
    }
}

$_POST['error'] = 'Unexpected error';
$_SESSION['tmp']['registration'] = $_POST;
$stmt->close();
header('Location: /registration');
die();
