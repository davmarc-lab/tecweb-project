<?php
    $userId = $_POST['id'];

    require_once "../../includes/database.php";

    $query = "SELECT IdUser, Name, Surname, Username, Email, Description, IdMedia FROM member WHERE IdUser = $userId;";
    $userInfo = $dbh->execQuery($query, MYSQLI_ASSOC)[0];

    echo(json_encode($userInfo));
?>
