<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$srcId = $_SESSION['userId'];
$dstId = $_POST['dstUser'];

require_once "../../includes/database.php";

$query = "SELECT *
        FROM message
        WHERE (IdSrc = $srcId AND IdDst = $dstId)
        OR (IdSrc = $dstId AND IdDst = $srcId)
        ORDER BY DateTime ASC";

$messages = $dbh->execQuery($query, MYSQLI_ASSOC);

if (sizeof($messages) > 0) {
    echo (json_encode($messages));
} else {
    echo ("");
}
