<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../../includes/database.php";
require_once "../../includes/utils.php";
$key = $_POST['key'];
$password = $_POST['password'];
$query = "SELECT * FROM member WHERE Email='$key' OR Username='$key';";
$res = $dbh->execQuery($query);
$numRows = count($res);
if ($numRows > 0) {
    foreach ($res as $user) {
        $dbPassword = $user['Password'];
        if (password_verify($password, $dbPassword)) {
            $_SESSION["userId"] = $res[0]['IdUser'];
            updateLastSeen($dbh, $_SESSION["userId"]);
            if (!isset($_COOKIE["theme"])) {
                setcookie("theme", "light", strtotime( '+30 days' ), "/");
            }
            echo "success";
            exit;
        } else {
            echo "error2";
        }
    }
} else {
    echo "error1";
}
