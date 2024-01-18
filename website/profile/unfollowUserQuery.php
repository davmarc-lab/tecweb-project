<?php
session_start();
require_once("../includes/database.php");
include_once("../includes/utils.php");

$srcUser = $_SESSION["userId"];
$dstUser = $_POST['dstUser'];

// find correct follow id
$query = "SELECT * FROM follow WHERE IdSrc = {$srcUser} AND IdDst = {$dstUser};";
$followId = $dbh->execQuery($query)[0]["Id"];

// remove follow
$query = "DELETE FROM follow WHERE Id = $followId";
$dbh->execQuery($query);

$tmp = NotificationType::FOLLOWER->value;
$query = "DELETE from notification WHERE Type = '{$tmp}' AND IdUser = {$dstUser} AND IdTarget = {$followId};";
$dbh->execQuery($query);

$query = "UPDATE utente SET NumberFollower = NumberFollower - 1 WHERE IdUser = '{$dstUser}';";
$dbh->execQuery($query);
