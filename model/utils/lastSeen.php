<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$id = $_SESSION['userId'];
$delete = $_POST['delete'];

if ($delete == -1) {
    $query = "UPDATE member SET lastseen = NOW() WHERE IdUser = $id";
} else {
    $query = "UPDATE member SET lastseen = NULL WHERE IdUser = $id";
}
$dbh->execQuery($query);
