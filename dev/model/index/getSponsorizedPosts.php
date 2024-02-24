<?php
    require_once "../../includes/database.php";
    $query = "SELECT * FROM Sponsor;";
    $res = $dbh->execQuery($query);
    echo json_encode($res);
?>