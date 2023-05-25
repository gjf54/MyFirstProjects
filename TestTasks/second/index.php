<?php
session_start();
$_SESSION['try_login'] = 0;


$url = explode('/', $_SERVER['REQUEST_URI']);

switch ($url[1]) {
    case '':
        $r_url = "views/index.html";
        $html = file_get_contents($r_url);
        print($html);
        break;
    case 'login':
        if (!isset($_COOKIE["user"])) {
            $r_url = "views/login.html";
            $html = file_get_contents($r_url);
            print($html);
        } else {
            $r_url = "views/profile.html";
            $html = file_get_contents($r_url);
            print($html);
        }
        break;
    case 'registration':
        if (!isset($_COOKIE['user'])) {
            $r_url = "views/registration.html";
            $html = file_get_contents($r_url);
            print($html);
        } else {
            $r_url = "views/profile.html";
            $html = file_get_contents($r_url);
            print($html);
        }
        break;
    case 'profile':
        if (isset($_COOKIE['user'])) {
            $r_url = "views/profile.html";
            $html = file_get_contents($r_url);
            print($html);
        } else {
            $r_url = "views/login.html";
            $html = file_get_contents($r_url);
            print($html);
        }
        break;
    default:
        $r_url = "views/page_not_found.html";
        $html = file_get_contents($r_url);
        print($html);
        header($url[1]);
        break;
}
