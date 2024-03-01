<?php
    require_once("../../includes/database.php");
    $idPost = $_POST["id"];
    $duration = $_POST["duration"];

    $str = "+" . $duration . "days";
    $expiration = date('Y-m-d', strtotime($str));

    $query = "INSERT INTO sponsor (Expiration, IdPost) VALUES ('{$expiration}', $idPost);";
    $dbh->execQuery($query);
?>