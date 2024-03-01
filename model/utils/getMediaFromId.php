<?php

require_once "../../includes/database.php";

$idMedia = $_POST['id'];

$query = "SELECT * FROM media WHERE IdMedia = $idMedia;";
$media = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

echo(json_encode($media));