<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";
require_once "../../includes/utils.php";

$userId = $_SESSION['userId'];

$query = "SELECT *
        FROM notification as n
        WHERE n.IdUser = $userId
        ORDER BY IdNotification DESC";
$notif = $dbh->execQuery($query, MYSQLI_ASSOC);

if (sizeof($notif) > 0) {
    echo (json_encode($notif));
} else {
    echo (false);
}
