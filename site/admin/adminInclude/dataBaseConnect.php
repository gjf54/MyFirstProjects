<?php

try {
    $mysqli = new mysqli('127.0.0.1', 'pilot', 'Zzxcasd2!', 'testBase');
    $mysqli->query('SET NAMES UTF8');
} catch (Exception $e) {
    echo 'connect error';
    die();
}
