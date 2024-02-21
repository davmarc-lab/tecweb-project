<?php
    include_once("../../includes/database.php");
    $query = "SELECT * FROM post WHERE Private = FALSE ORDER BY RAND() LIMIT 9;";
    $res = $dbh->execQuery($query);
    echo json_encode($res);
?>