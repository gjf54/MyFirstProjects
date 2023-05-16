<?php

include 'dataBaseConnect.php';

?>

<ul class="indexList">
    <li class="indexList-item"><a href="../catalog">Catalog</a></li>
    <li class="indexList-item">
        <?php
        if (isset($_SESSION['account']['id'])) {

            $sql = 'SELECT * FROM user WHERE id=' . (0 + $_SESSION['account']['id']);
            $res = $mysqli->query($sql);
            $thisUser = $res->fetch_assoc();
            echo '<a href="../profile">', $thisUser['name'], '</a>';
        } else {
            echo '<a href="../login">Sign In</a></li><li class="indexList-item"><a href="../registration">Sign Up</a>';
        }
        ?>
    </li>
</ul>