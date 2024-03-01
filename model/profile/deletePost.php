<?php
require_once "../../includes/database.php";
$idPost = $_POST["id"];

$queryGetPreview = "SELECT IdPreview FROM post WHERE IdPost = $idPost;";
$idPreview = $dbh->execQuery($queryGetPreview)[0]["IdPreview"];

$queryGetMedia = "SELECT IdMedia FROM post WHERE IdPost = $idPost;";
$idMedia = $dbh->execQuery($queryGetMedia)[0]["IdMedia"];

$queryDeletePreview = "DELETE FROM media WHERE IdMedia = $idPreview;";
$dbh->execQuery($queryDeletePreview);

$queryDeleteMedia = "DELETE FROM media WHERE IdMedia = $idMedia;";
$dbh->execQuery($queryDeleteMedia);

$queryDeleteNotification = "DELETE FROM `notification` WHERE IdNotification IN (SELECT IdNotification from notification WHERE type <> 'Follower' 
    AND (
        (IdTarget IN (SELECT IdVote from vote WHERE IdPost = $idPost) AND Type = 'Like')
    OR (IdTarget IN (SELECT IdComment from usercomment WHERE IdPost = $idPost) AND Type = 'Comment')));";
$dbh->execQuery($queryDeleteNotification);

$query = "DELETE FROM post WHERE IdPost = $idPost;";
$dbh->execQuery($query);
