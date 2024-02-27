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
        $query = "SELECT * FROM post p WHERE Title LIKE '%$searchKey%' AND Private = FALSE ";
    } else {
        $query = "SELECT * FROM post p";
    }
    $start = true;

    if (sizeof($filters) > 0) {
        $query.= "AND (";
        foreach ($filters as $filter) {
            if ($start) {
                $query.= "p.IdCategory = $filter ";
                $start = false;
            } else {
                $query.= "OR p.IdCategory = $filter ";
            }
        }
        $query .= ") ";
    }

    $query .= " ORDER BY p.NumberVote DESC;";
    $res = $dbh->execQuery($query);
    echo json_encode($res);  
?>