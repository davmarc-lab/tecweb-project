<?php
session_start();
require_once("../../includes/database.php");
$idPost = $_POST["idPost"];
$idUser = $_SESSION["userId"];
$text = $_POST["textComment"];

// author of the post
$query = "SELECT u.IdUser as IdUser FROM utente as u, post as p WHERE p.IdUser = u.IdUser AND p.IdPost = $idPost;";
$usrDst = $dbh->execQuery($query)[0]["IdUser"];

$query = "INSERT INTO usercomment (CommentText, IdPost, IdUser) VALUES ('{$text}', $idPost, $idUser);";
$dbh->execQuery($query);

$query = "UPDATE post SET NumberComment = NumberComment + 1 WHERE IdPost = $idPost;";
$dbh->execQuery($query);
?>