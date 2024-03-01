<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../../includes/database.php";

$query = "SELECT * FROM post WHERE IdUser = {$_SESSION["userId"]} AND Private = FALSE AND IdPost NOT IN (SELECT IdPost FROM sponsor);";
$posts = $dbh->execQuery($query, MYSQLI_ASSOC);

if (sizeof($posts) > 0) {
    echo (json_encode($posts));
} else {
    echo ("");
}
