<?php
    require_once("../../includes/database.php");

    $query = "DELETE FROM Sponsor WHERE Expiration < DATE_ADD(CURDATE(), INTERVAL 1 DAY);";
    $dbh->execQuery($query);
?>