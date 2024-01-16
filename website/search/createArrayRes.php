<?php
    include_once("../includes/database.php");
    session_start();
    $searchKey = $_POST["key"];
    $query = "SELECT * FROM utente WHERE Username LIKE '%$searchKey%' ORDER BY NumberFollower DESC;";
    $_SESSION["search_result"]["profile"] = $dbh->execQuery($query);
    $query = "SELECT * FROM post WHERE Title LIKE '%$searchKey%' ORDER BY NumberVote DESC;";
    $_SESSION["search_result"]["post"] = $dbh->execQuery($query);
?>