<?php
session_start();
require_once("includes/database.php");
include_once("includes/utils.php");

$query = "INSERT INTO vote (IdPost, IdUser) VALUES ('{$_POST['postId']}', '{$_SESSION['userId']}');";
$dbh->execQuery($query);
$targetId = mysqli_insert_id($dbh->getDataBaseController());
print_r($targetId);

$query = "UPDATE post SET NumberVote = NumberVote + 1 WHERE IdPost = '{$_POST['postId']}';";
$dbh->execQuery($query);

$query = "SELECT Username from utente WHERE IdUser = {$_SESSION['userId']};";
$username = $dbh->execQuery($query)[0]["Username"];

$tmp = NotificationType::LIKE->value;
$query = "INSERT INTO notification (Type, Description, IsRead, IdUser, IdTarget) VALUES ('$tmp', '{$username} liked your photo', 0, {$_POST['userId']}, {$targetId});";
$dbh->execQuery($query);

if (!checkUserOnline($dbh, $_POST['userId'])) {
    sendEmailNotification(getUserMail($dbh, $_POST['userId']), "You received a new like", "{$username} liked your photo");
}
?>
