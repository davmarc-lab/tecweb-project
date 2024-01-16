<?php
    include_once("../includes/database.php");
    session_start();
    $searchKey = $_POST["key"];
    if (isset($_POST["filters"])) {
        $filters = $_POST["filters"];
    } else {
        $filters = [];
    }
    $query = "SELECT * FROM utente WHERE Username LIKE '%$searchKey%' ORDER BY NumberFollower DESC;";
    $_SESSION["search_result"]["profile"] = $dbh->execQuery($query);
    //$query = "SELECT * FROM post WHERE Title LIKE '%$searchKey%' ORDER BY NumberVote DESC;";
    $query = "SELECT * FROM post p WHERE Title LIKE '%$searchKey%' ";
    foreach ($filters as $filter) {
        if (str_contains($query, "AND")) {
            $query .= " OR p.IdCategory = $filter";
        } else {
            $query .= "AND (p.IdCategory = $filter";
        }
    }
    if (str_contains($query, "AND")) {
        $query .= ")";
    }
    $query .= " ORDER BY p.NumberVote DESC;";
    $_SESSION["search_result"]["post"] = $dbh->execQuery($query);
?>