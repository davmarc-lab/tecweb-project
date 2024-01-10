<?php
session_start();
require_once("includes/database.php");
include_once("includes/utils.php");

$query = "SELECT IdVote from vote WHERE IdUser = '{$_SESSION['userId']}' AND IdPost = '{$_POST['postId']}';";
$idTarget = $dbh->execQuery($query)[0]["IdVote"];
print_r($idTarget);

$query = "DELETE from vote WHERE IdUser = '{$_SESSION['userId']}' AND IdPost = '{$_POST['postId']}';";
print_r("\nPrima query: " . $query);
$dbh->execQuery($query);

$query = "UPDATE post SET NumberVote = NumberVote - 1 WHERE IdPost = '{$_POST['postId']}'";
$dbh->execQuery($query);

$tmp = NotificationType::LIKE->value;
$query = "DELETE from notification WHERE Type = '{$tmp}' AND IdUser = {$_POST['userId']} AND IdTarget = {$idTarget};";
print_r("\nSeconda query: " . $query);
$dbh->execQuery($query);
?>
