<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("../../includes/database.php");

    $query = "SELECT * FROM post WHERE Private = FALSE AND IdUser <> {$_SESSION['userId']} ORDER BY RAND() LIMIT 9;";
    $res = $dbh->execQuery($query);
    echo json_encode($res);
?>