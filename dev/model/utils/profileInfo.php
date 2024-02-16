<?php

$userId = $_POST['id'];

require_once "../../include/database.php";

$query = "SELECT IdUser, Username, IdMedia FROM member WHERE IdUser = $userId;";
$userInfo = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

$query = "SELECT FilePath from media WHERE IdMedia = {$userInfo['IdMedia']};";
$media = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

echo(json_encode(array_merge($userInfo, $media)));
