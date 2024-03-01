<?php

require_once "../../includes/database.php";

$idPost = $_POST['idPost'];

$query = "SELECT * FROM post WHERE IdPost = $idPost;";
$infoPost = $dbh->execQuery($query);

if (sizeof($infoPost) > 0) {
    echo(json_encode($infoPost[0]));
} else {
    echo ("error");
}
