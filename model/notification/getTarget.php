<?php

require_once "../../includes/database.php";
require_once "../../includes/utils.php";

$type = $_POST['type'];
$target = $_POST['target'];

if ($type == NotificationType::COMMENT->value) {
    $query = "SELECT IdPost as Target from usercomment WHERE IdComment = '$target';";
} else if ($type == NotificationType::LIKE->value) {
    $query = "SELECT IdPost as Target from vote WHERE IdVote = '$target';";
} else {
    $query = "SELECT IdSrc as Target from follow WHERE Id = '$target';";
}

$res = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

echo(json_encode($res));