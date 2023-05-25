<?php

session_start();
include_once('dbConnect.php');

$data = json_decode(file_get_contents("php://input"));
header("Content-Type: application/json");

$is_password = true;

$rexpr = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[-*+!]).{8,20}$/';

if (isset($data->new_password)) {
    if (!preg_match($rexpr, $data->new_password)) {
        $is_password = true;
        $user['error'] = 'weak new password';
        $user['type'] = $data->type;
        echo json_encode($user);
        die();
    }
} else {
    $is_password = false;
}

$rexpr = '/^[-a-zа-яё ]{1,20}$/i';

if (!preg_match($rexpr, $data->name)) {
    $user['error'] = 'use correct name';
    $user['type'] = $data->type;
    echo json_encode($user);
    die();
}

$rexpr = '/^[-a-z\d_]{1,16}$/i';

if (!preg_match($rexpr, $data->new_login)) {
    $user['error'] = 'incorrect login';
    $user['type'] = $data->type;
    echo json_encode($user);
    die();
}

try {

    $sql = "SELECT id FROM user WHERE login =? AND password =?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $data->login, md5($data->password));
    $stmt->execute();

    if (!$stmt->fetch()) {
        $user['error'] = 'incorrect password';
        $user['type'] = $data->type;
        $stmt->close();
        echo json_encode($user);
        die();
    }
    $stmt->close();

    if ($is_password) {
        $sql = "UPDATE user SET name =?, mail =?, login =?, password =? WHERE login =?";
    } else {
        $sql = "UPDATE user SET name =?, mail =?, login =? WHERE login =?";
    }

    $stmt = $mysqli->prepare($sql);
    if ($is_password) {
        $stmt->bind_param('sssss', $data->name, $data->mail, $data->new_login, md5($data->new_password), $data->login);
    } else {
        $stmt->bind_param('ssss', $data->name, $data->mail, $data->new_login, $data->login);
    }

    $stmt->execute();
    $stmt->close();

    $user['login'] = $data->new_login;
    $user['name'] = $data->name;
    $user['mail'] = $data->mail;
    $user['type'] = $data->type;
    echo json_encode($user);
} catch (Exception $e) {
    $user['type'] = $data->type;
    $user['error'] = 'Unknown error';
    $file = "../logs/err_log.txt";
    file_put_contents($file, $e);
    echo json_encode($user);
}
