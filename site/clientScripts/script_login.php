<?php
include '../clientInclude/dataBaseConnect.php';

session_start();

try {
    $sql = 'SELECT id FROM user WHERE login=? AND password=? LIMIT 1';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $_POST['login'], md5($_POST['password']));
    $stmt->bind_result($userId);
    $stmt->execute();

    if ($stmt->fetch()) {
        $_SESSION['account']['id'] = $userId;
        $stmt->close();
        header('Location: /');
        die();
    }

    $_POST['error'] = 'Uncorrect login or password';
    $_SESSION['tmp']['login'] = $_POST;
    header('Location: /login');
    die();
} catch (Exception $e) {
    $_POST['error'] = 'Unexpected error';
    $_SESSION['tmp']['login'] = $_POST;
    $stmt->close();
    header('Location: /login');
    die();
}
