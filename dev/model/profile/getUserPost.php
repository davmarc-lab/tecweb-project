<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$userId = $_POST['id'];

$query = "SELECT * FROM post WHERE IdUser = $userId";

if ($userId != $_SESSION["userId"]) {
    //check if follow

    $queryFollow = "SELECT * FROM follow WHERE IdSrc = {$_SESSION["userId"]} AND IdDst = $userId";
    $test = $dbh->execQuery($queryFollow);
    if (sizeof($test) == 0) {
        //add private posts filter
        $query .= " AND Private = FALSE";
    }
}

$query .= " ORDER BY Date DESC;";

$posts = $dbh->execQuery($query, MYSQLI_ASSOC);

if (sizeof($posts) > 0) {
    echo (json_encode($posts));
} else {
    echo ("");
}
