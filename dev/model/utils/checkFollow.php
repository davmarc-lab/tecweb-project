<?php
    require_once '../../includes/database.php';
    $idSrc = $_GET["IdSrc"];
    $idDst = $_GET["IdDst"];
    $query = "SELECT * FROM follow WHERE IdSrc = {$IdSrc} AND IdDst = {$IdDst}";
    $test = $dbh->execQuery($query);
    echo sizeof($test);
?>