<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../../includes/database.php';

$idDst = $_POST["IdDst"];
$idSrc = $_SESSION["userId"];

$query = "SELECT * FROM follow WHERE IdSrc = $idSrc AND IdDst = $idDst";
$test = $dbh->execQuery($query);
echo sizeof($test);
