<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$message = $_POST['message'];
$dst = $_POST['dst'];
$src = $_SESSION['userId'];

$query = "INSERT INTO message (Content, IdSrc, IdDst)
        VALUES ('$message', $src, $dst);";

$dbh->execQuery($query);
echo ($src);