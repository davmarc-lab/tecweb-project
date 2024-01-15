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
    $dbh->execQuery($query);

    $query = "UPDATE utente SET NumberFollower = NumberFollower + 1 WHERE IdUser = '{$dstUser}';";
    $dbh->execQuery($query);
    
   /*  if (!checkUserOnline($dbh, $_POST['userId'])) {
        mail("penazziriccardo17@gmail.com", "You have a new follower", "{$username} started following you");
    } */
    sendEmailNotification(getUserMail($dbh, $dstUser), "You have a new follower", "{$username} started following you");
?>