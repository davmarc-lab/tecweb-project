<?php
require_once("../includes/database.php");
$idUser = $_POST["idUser"];
$query = "SELECT Username from utente WHERE IdUser = $idUser;";
$res = $dbh->execQuery($query, MYSQLI_ASSOC)[0]["Username"];
echo($res);
?>