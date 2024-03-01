<?php
    require_once("../../includes/database.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $query = "SELECT * FROM notification WHERE IdUser = {$_SESSION["userId"]} AND IsRead = 0;";
    $res = $dbh->execQuery($query);
    echo count($res);
?>