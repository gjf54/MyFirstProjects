<?php

session_start();
include_once('dbConnect.php');

$data = json_decode(file_get_contents("php://input"));
header("Content-Type: application/json");

$rexpr = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[-*+!]).{8,20}$/';

if (!preg_match($rexpr, $data->password)) {
    $user['error'] = 'password not strong';
    $user['type'] = $data->type;
    echo json_encode($user);
    die();
}

$rexpr = '/^[-a-zа-яё\d ]{1,20}$/i';

if (!preg_match($rexpr, $data->name)) {
    $user['error'] = 'use correct name';
    $user['type'] = $data->type;
    echo json_encode($user);
    die();
}

$rexpr = '/^[-a-z\d_]{1,16}$/i';

if (!preg_match($rexpr, $data->login)) {
    $user['error'] = 'incorrect login';
    $user['type'] = $data->type;
    echo json_encode($user);
    die();
}

try {
    $sql = 'INSERT INTO user (name,login,password,mail) VALUES (?,?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssss', $data->name, $data->login, md5($data->password), $data->mail);
    $user['name'] = $data->name;
    $user['login'] = $data->login;
    $user['mail'] = $data->mail;
    $user['type'] = $data->type;
    $stmt->execute();
    $stmt->close();

    echo json_encode($user);
} catch (Exception $e) {
    $user['type'] = $data->type;
    $user['error'] = 'Unknown error. Try later';
    $file = "../logs/err_log.txt";
    file_put_contents($file, $e);
    echo json_encode($user);
}
