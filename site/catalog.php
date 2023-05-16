<?php

include 'clientInclude/dataBaseConnect.php';
include 'clientInclude/mainPage.php';

session_start();

if (isset($_GET['id'])) {
    $id = 0 + $_GET['id']; //intval($_GET['id']);
    $sql = 'SELECT name FROM categories WHERE id=? LIMIT 1';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->bind_result($nameCategory);
    $stmt->execute();
    if (!$stmt->fetch()) {
        die('404');
    }
    $stmt->close();
} else {
    $id = 0;
}

// echo $id;


echo '<ul class="category-catalogTable">';
if ($id) {
    if (isset($nameCategory)) {
        echo '<li class="category-catalogTable-sectorName"><h1 class="category-catalogTable-sectorName-text">', $nameCategory, '</h1></li>';
    }
    $sql = 'SELECT id,name,url FROM categories WHERE parentCategory=? ORDER BY numSort DESC';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->bind_result($sId, $sName, $sUrl);
    $stmt->execute();
    while ($stmt->fetch()) {
        echo '<li class="category-catalogTable-element"><a href="/catalog.php?id=', $sId, '" class="category-catalogTable-childLinkOfCategory">', $sName, '</a></li>';
    }
    $stmt->close();
    echo '</ul>';
    echo '<a href="/catalog.php" style="display:inline-block; margin-top: 1.2em;" class="category-catalogTable-returnButton">Back</a>';
} else {
    $sql = 'SELECT id,name,url FROM categories WHERE parentCategory is NULL ORDER BY numSort DESC';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_result($mId, $mName, $mUrl);
    $stmt->execute();
    while ($stmt->fetch()) {
        echo '<li class="category-catalogTable-element"><a href="/catalog.php?id=', $mId, '" class="category-catalogTable-parentLinkOfCategory">', $mName, '</a></li>';
    }
    $stmt->close();
    echo '</ul>';

    echo '<a href="/" class="category-catalogTable-returnToMainPageButton">Back</a>';
}
