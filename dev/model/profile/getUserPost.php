<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$userId = $_POST['id'];

$query = "SELECT * FROM post WHERE IdUser = $userId";
$posts = $dbh->execQuery($query, MYSQLI_ASSOC);

if (sizeof($posts) > 0) {
    echo(json_encode($posts));
} else {
    echo("");
}