<?php
require_once("../../includes/database.php");
$key = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM utente WHERE Email='$key' OR Username='$key';";
$res = $dbh->execQuery($query);
$numRows = count($res);
if ($numRows > 0) {
    foreach ($res as $user) {
        $dbPassword = $user['Password'];
        if (password_verify($password, $dbPassword)) {
            session_start();
            $_SESSION["userId"] = $res[0]['IdUser'];
            header("location:../../index.php");
            exit;
        }
    }
} else {
    header("location:../login.php?error=1");
}
