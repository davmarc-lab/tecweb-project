<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once '../../includes/database.php';

$userId = $_SESSION['userId'];

$query = "SELECT DISTINCT IdUser
        FROM message as m, member as u
        WHERE (u.IdUser = m.IdSrc OR u.IdUser = m.IdDst)
        AND (m.IdSrc = $userId OR m.IdDst = $userId)
        AND IdUser != $userId
        ORDER BY DateTime DESC;";
$userChats = $dbh->execQuery($query, MYSQLI_ASSOC);

if (count($userChats) > 0) {
    echo (json_encode($userChats));
} else {
    echo ("");
}
