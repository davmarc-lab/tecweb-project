<?php
    session_start();
    require_once("../includes/database.php");
    include_once("../includes/utils.php");

    $srcUser = $_SESSION["userId"];
    $dstUser = $_POST['dstUser'];

    $query = "SELECT Id from follow WHERE IdSrc = $srcUser AND IdDst = $dstUser;";
    $test = $dbh->execQuery($query);

    if (count($test) == 0) {
        $query = "INSERT INTO follow (IdSrc, IdDst) VALUES ($srcUser, $dstUser);";
        $dbh->execQuery($query);
        $targetId = mysqli_insert_id($dbh->getDataBaseController());
    
        $query = "SELECT Username from member WHERE IdUser = {$srcUser};";
        $username = $dbh->execQuery($query)[0]["Username"];
    
        $tmp = NotificationType::FOLLOWER->value;
        $query = "INSERT INTO notification (Type, Description, IsRead, IdUser, IdTarget) VALUES ('$tmp', '{$username} started following you', 0, {$dstUser}, {$targetId});";
        $dbh->execQuery($query);
    
        $query = "UPDATE member SET NumberFollower = NumberFollower + 1 WHERE IdUser = '{$dstUser}';";
        $dbh->execQuery($query);
        
        if (!checkUserOnline($dbh, $dstUser)) {
            sendEmailNotification(getUserMail($dbh, $dstUser), "You have a new follower", "{$username} started following you");
        }
    }

?>