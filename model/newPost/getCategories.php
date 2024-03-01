<?php
    require_once("../../includes/database.php");
    $query = "SELECT * FROM category";
    $categories = $dbh->execQuery($query);
    echo json_encode($categories);
?>