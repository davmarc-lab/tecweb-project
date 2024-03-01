<?php

$userId = $_POST['id'];

require_once "../../includes/database.php";

$query = "SELECT * FROM member WHERE IdUser = $userId";
$user = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

echo(json_encode($user));