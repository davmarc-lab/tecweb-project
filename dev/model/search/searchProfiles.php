<?php
    include_once("../../includes/database.php");
    $searchKey = $_POST["key"];
    unset($_POST["key"]);
    if (strlen($searchKey) > 0) {
        $query = "SELECT * FROM member WHERE Username LIKE '%$searchKey%' ORDER BY NumberFollower DESC;";
        echo json_encode($dbh->execQuery($query));
    } else {
        echo "";
    }
?>