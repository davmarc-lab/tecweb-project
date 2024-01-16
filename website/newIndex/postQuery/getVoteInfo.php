<?php
session_start();
require_once("../../includes/database.php");
$idUser = $_SESSION["userId"];
$idPost = $_POST["idPost"];
$query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = $idUser;";
$res = $dbh->execQuery($query, MYSQLI_ASSOC);
print_r(count($res));
?>