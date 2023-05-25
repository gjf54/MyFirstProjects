<?php
session_start();
include_once('dbConnect.php');

$data = json_decode(file_get_contents("php://input"));
header("Content-Type: application/json");

try {
    $sql = "DELETE FROM user WHERE login=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $data->login);
    $stmt->execute();
    $stmt->close();

    $user['type'] = $data->type;
    echo json_encode($user);
} catch (Exception $e) {
    $user['type'] = $data->type;
    $user['error'] = 'Unknown error. Try later';
    $file = "../logs/err_log.txt";
    file_put_contents($file, $e);
    echo json_encode($user);
}
