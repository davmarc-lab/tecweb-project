<?php
    session_start();
    require_once("includes/database.php");
    $query = "DELETE from vote WHERE IdUser = '{$_SESSION['userId']}' AND IdPost = '{$_POST['postId']}';";
    $dbh->execQuery($query);
    $query = "UPDATE post SET NumberVote = NumberVote - 1 WHERE IdPost = '{$_POST['postId']}'";
    $dbh->execQuery($query);
?>
