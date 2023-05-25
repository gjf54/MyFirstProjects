<?php

try {
    $mysqli = new mysqli('127.0.0.1', 'task', 'Abcdefg!!!', 'secondtaskdb');
    $mysqli->query('SET NAMES UTF8');
} catch (Exception $e) {
    echo 'connect error';
    die();
}
