<?php
session_start();
require_once("includes/database.php");
$idPost = $_POST['idPost'];
$comment = $_POST['commentText'];
$query = "INSERT INTO usercomment (CommentText, IdPost, IdUser) VALUES ('{$comment}', '{$idPost}', {$_SESSION['userId']});";
$dbh->execQuery($query);
$queryInc = "UPDATE post SET NumberComment = NumberComment + 1 WHERE IdPost = '{$idPost}';";
$dbh->execQuery($queryInc);
header("Location:index.php");
?>
