<?php
    session_start();
    require_once("includes/database.php");
    $query = "INSERT INTO vote (IdPost, IdUser) VALUES ('{$_POST['postId']}', '{$_SESSION['userId']}');";
    $dbh->execQuery($query);
    $query = "UPDATE post SET NumberVote = NumberVote + 1 WHERE IdPost = '{$_POST['postId']}';";
    $dbh->execQuery($query);
?>
