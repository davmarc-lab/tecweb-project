<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$user = $_POST['user'];

$query = "SELECT u.IdUser, u.Username, u.IdMedia
        FROM follow AS f
        JOIN member AS u ON f.IdSrc = u.IdUser
        WHERE f.IdDst = $user;";
$followers = $dbh->execQuery($query, MYSQLI_ASSOC);

echo (json_encode($followers));
