<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$userId = $_SESSION['userId'];

$query = "UPDATE notification
        SET IsRead = 1
        WHERE IdUser = $userId;";

$dbh->execQuery($query);