<?php
require_once("../includes/database.php");
$idPost = $_POST["idPost"];
$query = "SELECT * FROM usercomment WHERE IdPost = $idPost
        ORDER BY IdComment DESC LIMIT 3;";
$res = $dbh->execQuery($query, MYSQLI_ASSOC);
print_r(json_encode($res));
?>
