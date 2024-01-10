<?php
session_start();
require_once("includes/database.php");
include_once("includes/utils.php");

$query = "INSERT INTO vote (IdPost, IdUser) VALUES ('{$_POST['postId']}', '{$_SESSION['userId']}');";
$dbh->execQuery($query);

$query = "UPDATE post SET NumberVote = NumberVote + 1 WHERE IdPost = '{$_POST['postId']}';";
$dbh->execQuery($query);

$tmp = NotificationType::LIKE->value;
$query = "INSERT INTO notification (Type, Description, IsRead, IdUser) VALUES ('$tmp', '{$_SESSION['userId']} liked your photo', 0, {$_POST['userId']});";
$dbh->execQuery($query);
?>
