<?php
session_start();
require_once("../includes/database.php");
$idUser = $_SESSION["userId"];

// author of the post
$query = "SELECT IdUser, Username FROM member WHERE IdUser = $idUser;";
$res = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

print_r(json_encode($res));
?>