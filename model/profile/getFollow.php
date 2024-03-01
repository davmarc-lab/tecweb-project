<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";
$user = -1;

if (isset($_POST['user'])) {
    $user = $_POST['user'];
} else {
    $user = $_SESSION['userId'];
}
$query = "SELECT u.IdUser, u.Username, u.IdMedia
        FROM follow AS f
        JOIN member AS u ON f.IdDst = u.IdUser
        WHERE f.IdSrc = $user";
$follow = $dbh->execQuery($query, MYSQLI_ASSOC);

if (empty($follow)) {
    echo ("");
} else {
    echo (json_encode($follow));
}
