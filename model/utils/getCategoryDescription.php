<?php
    require_once "../../includes/database.php";
    $queryCategory = "SELECT Description FROM category WHERE IdCategory = {$_POST['Id']};";
    $category = $dbh->execQuery($queryCategory)[0]["Description"];
    echo $category;
?>