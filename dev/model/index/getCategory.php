<?php
require_once "../../includes/database.php";
$idCategory = $_POST["idCategory"];

$query = "SELECT * FROM category WHERE IdCategory = $idCategory";
$res = $dbh->execQuery($query, MYSQLI_ASSOC)[0];
print_r(json_encode($res));
?>