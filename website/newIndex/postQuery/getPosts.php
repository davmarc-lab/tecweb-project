<?php
require_once("../../includes/database.php");
$limit = $_POST["limit"];
$query = "SELECT * FROM post LIMIT $limit";
$res = $dbh->execQuery($query, MYSQLI_ASSOC);
// this line work
echo(json_encode($res));
?>