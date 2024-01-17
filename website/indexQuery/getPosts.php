<?php
session_start();
require_once("../includes/database.php");
$idUser = $_SESSION["userId"];

$query = "SELECT post.*
        FROM post
        JOIN follow ON post.IdUser = follow.IdDst
        WHERE follow.IdSrc = $idUser
        ORDER BY post.Date ASC;";
$res = $dbh->execQuery($query, MYSQLI_ASSOC);

echo (json_encode($res));
