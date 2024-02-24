<?php
    require_once "../../includes/database.php";
    $query = "SELECT * FROM sponsor;";
    $res = $dbh->execQuery($query);
    echo json_encode($res);
?>