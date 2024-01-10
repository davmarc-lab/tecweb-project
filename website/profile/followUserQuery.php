<?php
    require_once("../includes/database.php");

    $srcUser = $_POST['srcUser'];
    $dstUser = $_POST['dstUser'];
    $query = "INSERT INTO follow (IdSrc, IdDst) VALUES ($srcUser, $dstUser);";
    $dbh->execQuery($query);
?>