<?php
    require_once("../includes/database.php");
    include_once("../includes/utils.php");

    $srcUser = $_POST['srcUser'];
    $dstUser = $_POST['dstUser'];
    $query = "INSERT INTO follow (IdSrc, IdDst) VALUES ($srcUser, $dstUser);";
    $dbh->execQuery($query);
    $targetId = mysqli_insert_id($dbh->getDataBaseController());

    $query = "SELECT Username from utente WHERE IdUser = {$srcUser};";
    $username = $dbh->execQuery($query)[0]["Username"];

    $tmp = NotificationType::FOLLOWER->value;
    $query = "INSERT INTO notification (Type, Description, IsRead, IdUser, IdTarget) VALUES ('$tmp', '{$username} started following you', 0, {$dstUser}, {$targetId});";
    print_r($query);
    $dbh->execQuery($query);
?>