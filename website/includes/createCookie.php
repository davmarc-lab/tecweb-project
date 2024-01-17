<?php
session_start();
if (!isset($_COOKIE["user" . $_SESSION["userId"]])) {
    $cookieName = "user" . $_SESSION["userId"];
    $cookieValue = $_SESSION["userId"];
    setcookie($cookieName, $cookieValue, strtotime( '+30 days' ), "/");
    echo $_COOKIE[$cookieName];
}
?>