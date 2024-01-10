<?php
    require_once("../includes/database.php");

    $srcUser = $_POST['srcUser'];
    $dstUser = $_POST['dstUser'];

    // find correct follow id
    $query = "SELECT * FROM follow WHERE IdSrc = $srcUser AND IdDst = $dstUser";
    $followId = $dbh->execQuery($query)[0]["Id"];
    
    // remove follow
    $query = "DELETE FROM follow WHERE Id = $followId";
    $dbh->execQuery($query);
?>