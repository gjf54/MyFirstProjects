<?php
session_start();
include_once('dbConnect.php');

$data = json_decode(file_get_contents("php://input"));
header("Content-Type: application/json");

try {
    $sql = "SELECT name,login,mail FROM user WHERE login=? AND password=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $data->login, md5($data->password));
    $stmt->bind_result($user['name'], $user['login'], $user['mail']);
    $stmt->execute();

    if ($stmt->fetch()) {
        $stmt->close();
        $user['type'] = $data->type;
        echo json_encode($user);
    } else {
        $user['type'] = $data->type;
        $user['error'] = "Incorrect login or password!";
        $_SESSION['try_login'] += 1;

        if ($_SESSION['try_login'] > 2) {
            $user['load_captcha'] = true;
        }

        echo json_encode($user);
    }
} catch (Exception $e) {
    $user['type'] = $data->type;
    $user['error'] = 'Unknown error. Try later';
    $file = "../logs/err_log.txt";
    file_put_contents($file, $e);
    echo json_encode($user);
}
