<?php
    require_once("../includes/database.php");
    $categoryDescription = $_POST["description"];
    $query = "INSERT INTO category (Description) VALUES(\"$categoryDescription\");";
    $dbh->execQuery($query);
    $lastId = $dbh->getDataBaseController()->insert_id;
    // echo for response value
    echo($lastId);
?>