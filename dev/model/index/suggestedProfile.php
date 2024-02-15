<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once("../../include/database.php");

$_SESSION["userId"] = 2;

$query = "SELECT u.*
    FROM member u
    WHERE u.IdUser <> {$_SESSION['userId']}
    AND u.IdUser NOT IN (SELECT f.IdDst FROM follow f WHERE f.IdSrc = {$_SESSION['userId']})
    ORDER BY RAND()
    LIMIT 5;";

$res = $dbh->execQuery($query);

echo(json_encode($res));
