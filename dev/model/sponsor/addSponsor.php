<?php
    require_once("../../includes/database.php");
    $idPost = $_POST["id"];
    $duration = $_POST["duration"];

    $str = "+" . $duration . "days";
    $expiration = date('Y-m-d', strtotime($str));

    echo $expiration;

    $query = "INSERT INTO Sponsor (Expiration, IdPost) VALUES ('{$expiration}', $idPost);";
    $dbh->execQuery($query);
?>