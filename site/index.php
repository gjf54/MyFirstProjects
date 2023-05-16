<?php

session_start();

// print_r($_SERVER);
$url = explode('/', $_SERVER['REQUEST_URI']);

if (isset($_GET['logOut'])) {
    unset($_SESSION['tmp']['account']['name']);
    header('Location: /');
    die();
}

ob_start();
switch ($url[1]) {
    case '':
    case 'index':
        include 'clientInclude/mainPage.php';
        include 'clientInclude/defaultIndexPage.php';
        break;
    case 'catalog':
        include 'clientInclude/mainPage.php';
        include 'catalog.php';
        break;
    case 'registration':
        include 'clientInclude/mainPage.php';
        include 'registration.php';
        break;
    case 'login':
        include 'clientInclude/mainPage.php';
        include 'login.php';
        break;
    case 'profile':
        include 'clientInclude/mainPage.php';
        include 'profile.php';
        break;
    default:
        include 'clientInclude/mainPage.php';
        include 'clientInclude/pageNotFound.php';
}
$content = ob_get_contents();
ob_clean();
//буферизация
