<?php

require_once "../../includes/database.php";

$idPost = $_POST['idPost'];

$query = "SELECT * FROM usercomment WHERE IdPost = $idPost
        ORDER BY IdComment ASC;";
$comments = $dbh->execQuery($query);
$comments = array_reverse($comments);

echo(json_encode($comments));