<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../../includes/database.php";
require_once "../../includes/utils.php";
$key = $_POST['key'];
$password = $_POST['password'];
$_SESSION['oldValueLogin'] = [
    "username" => $key,
];
$query = "SELECT * FROM member WHERE Email='$key' OR Username='$key';";
$res = $dbh->execQuery($query);
$numRows = count($res);
if ($numRows > 0) {
    foreach ($res as $user) {
        $dbPassword = $user['Password'];
        if (password_verify($password, $dbPassword)) {
            $_SESSION["userId"] = $res[0]['IdUser'];
            updateLastSeen($dbh, $_SESSION["userId"]);
            unset($_SESSION['oldValueLogin']);
            if (!isset($_COOKIE["theme"])) {
                setcookie("theme", "light", strtotime( '+30 days' ), "/");
            }
            //header("location:../../index.php");
            echo "success";
            exit;
        } else {
            //header("location:../login.php?error=2");
            echo "error2";
        }
    }
} else {
    //header("location:../login.php?error=1");
    echo "error1";
}
