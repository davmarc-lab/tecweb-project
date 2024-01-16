<?php
    require_once("includes/database.php");
    $query = "SELECT NumberVote from post WHERE IdPost = '{$_GET['postId']}';";
    $res = $dbh->execQuery($query)[0]['NumberVote'];
    echo ((int)$res);
?>