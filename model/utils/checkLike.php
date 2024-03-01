<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../../includes/database.php";

$idUser = $_SESSION['userId'];
$idPost = $_POST['idPost'];

$query = "SELECT COUNT(*) as count FROM vote WHERE IdPost = $idPost AND IdUser = $idUser";
$res = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

echo($res['count']);