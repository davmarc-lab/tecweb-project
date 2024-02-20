<?php
    include_once("../../includes/database.php");
    session_start();
    $searchKey = $_POST["key"];
    unset($_POST["key"]);
    if (isset($_POST["filters"])) {
        $filters = $_POST["filters"];
    } else {
        $filters = [];
    }
    if (strlen($searchKey) > 0) {
        $query = "SELECT * FROM member WHERE Username LIKE '%$searchKey%' ORDER BY NumberFollower DESC;";
        $_SESSION["search_result"]["profile"] = $dbh->execQuery($query);
    } else {
        $_SESSION["search_result"]["profile"] = [];
    }
    if (strlen($searchKey) > 0) {
        $query = "SELECT * FROM post p WHERE Title LIKE '%$searchKey%' ";
    } else {
        $query = "SELECT * FROM post p";
    }
    $start = false;
    foreach ($filters as $filter) {
        if (str_contains($query, "AND") || $start) {
            $query .= " OR p.IdCategory = $filter";
        } else {
            if (strlen($searchKey) > 0) {
                $query .= "AND (p.IdCategory = $filter";
            } else {
                $query .= " WHERE p.IdCategory = $filter";
                $start = true;
            }
        }
    }
    if (str_contains($query, "AND")) {
        $query .= ")";
    }
    $query .= " ORDER BY p.NumberVote DESC;";
    //$_SESSION["search_result"]["post"] = $dbh->execQuery($query);
    $res = $dbh->execQuery($query);
    echo json_encode($res);  
?>