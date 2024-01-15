<?php
session_start();
require_once("includes/database.php");
include_once("includes/utils.php");
$idPost = $_POST['idPost'];
$query = "SELECT u.IdUser as IdUser FROM utente as u, post as p WHERE p.IdUser = u.IdUser AND p.IdPost = $idPost;";
$usrDst = $dbh->execQuery($query)[0]["IdUser"];
$comment = $_POST['commentText'];
$query = "INSERT INTO usercomment (CommentText, IdPost, IdUser) VALUES ('{$comment}', '{$idPost}', {$_SESSION['userId']});";
$dbh->execQuery($query);
$queryInc = "UPDATE post SET NumberComment = NumberComment + 1 WHERE IdPost = '{$idPost}';";
$dbh->execQuery($queryInc);
$query = "SELECT Username from utente WHERE IdUser = {$_SESSION['userId']};";
$username = $dbh->execQuery($query)[0]["Username"];
$tmp = NotificationType::COMMENT->value;
$query = "INSERT INTO notification (Type, Description, IsRead, IdUser) VALUES ('$tmp', '{$username} added a comment to your post', 0, $usrDst);";
$dbh->execQuery($query);
sendEmailNotification(getUserMail($dbh, $usrDst), "You have a new comment on your post", "{$username} added a comment to your post: {$comment}");
header("Location:" . $_POST['locationTo']);
?>
