<?php
session_start();
require_once("../../includes/database.php");
require_once("../../includes/utils.php");

$idPost = $_POST["idPost"];
$idUser = $_SESSION["userId"];
$text = $_POST["textComment"];

// author of the post
$query = "SELECT u.IdUser, u.Username as IdUser FROM utente as u, post as p WHERE p.IdUser = u.IdUser AND p.IdPost = $idPost;";
$result = $dbh->execQuery($query);
$usrDst = $result[0]["IdUser"];
$username = $result[0]["Username"];

$query = "INSERT INTO usercomment (CommentText, IdPost, IdUser) VALUES ('{$text}', $idPost, $idUser);";
$dbh->execQuery($query);
$targetId = mysqli_insert_id($dbh->getDataBaseController());

$query = "UPDATE post SET NumberComment = NumberComment + 1 WHERE IdPost = $idPost;";
$dbh->execQuery($query);

$tmp = NotificationType::COMMENT->value;
$query = "INSERT INTO notification (Type, Description, IsRead, IdUser, IdTarget) VALUES ('$tmp', '{$username} added a comment to your post', 0, $usrDst, $targetId);";
$dbh->execQuery($query);

if (!checkUserOnline($dbh, $usrDst)) {
    sendEmailNotification(getUserMail($dbh, $usrDst), "You have a new comment on your post", "{$username} added a comment to your post: {$text}");
}
?>