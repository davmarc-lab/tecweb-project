<?php
session_start();
require_once("../../includes/database.php");
$idUser = $_SESSION["userId"];
$idPost = $_POST["idPost"];
$increment = $_POST["increment"];
$res = "";

if ($increment > 0) {
    // insert new vote
    $query = "INSERT INTO vote (IdPost, IdUser) VALUES ($idPost, $idUser);";
    $dbh->execQuery($query);
    $targetId = mysqli_insert_id($dbh->getDataBaseController());

    $query = "UPDATE post SET NumberVote = NumberVote + 1 WHERE IdPost = $idPost;";
    $dbh->execQuery($query);

    $query = "SELECT Username from utente WHERE IdUser = $idUser;";
    $username = $dbh->execQuery($query)[0]["Username"];
    $res = "INCREMENT";
} else {
    // need to delete the vote
    $query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = $idUser;";
    $idVote = $dbh->execQuery($query, MYSQLI_ASSOC)[0]["IdVote"];

    $query = "DELETE FROM vote WHERE IdVote = $idVote;";
    $dbh->execQuery($query);

    $query = "UPDATE post SET NumberVote = NumberVote - 1 WHERE IdPost = $idPost;";
    $dbh->execQuery($query);
    $res = "DELETED";
}
print_r($res);
