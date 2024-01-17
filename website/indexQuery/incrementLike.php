<?php
session_start();
require_once("../includes/database.php");
require_once("../includes/utils.php");
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

    $query = "SELECT IdUser from post WHERE IdPost = '{$idPost}'";
    $idDst = $dbh->execQuery($query)[0]["IdUser"];

    $tmp = NotificationType::LIKE->value;
    $query = "INSERT INTO notification (Type, Description, IsRead, IdUser, IdTarget) VALUES ('$tmp', '{$username} liked your post', 0, $idDst, {$targetId});";
    $dbh->execQuery($query);

    if (!checkUserOnline($dbh, $idDst)) {
        sendEmailNotification(getUserMail($dbh, $idDst), "You received a new like", "{$username} liked your post");
    }

    $res = "INCREMENT";
} else {
    // need to delete the vote
    $query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = $idUser;";
    $idVote = $dbh->execQuery($query, MYSQLI_ASSOC)[0]["IdVote"];

    $query = "DELETE FROM vote WHERE IdVote = $idVote;";
    $dbh->execQuery($query);

    $query = "UPDATE post SET NumberVote = NumberVote - 1 WHERE IdPost = $idPost;";
    $dbh->execQuery($query);

    $query = "SELECT IdUser from post WHERE IdPost = '{$idPost}'";
    $idDst = $dbh->execQuery($query)[0]["IdUser"];

    $tmp = NotificationType::LIKE->value;
    $query = "DELETE from notification WHERE Type = '{$tmp}' AND IdUser = '{$idDst}' AND IdTarget = '{$idVote}';";
    $dbh->execQuery($query);

    $res = "DELETED";
}
print_r($res);
