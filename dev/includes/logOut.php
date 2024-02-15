<?php
    require_once("database.php");
    require_once("utils.php");
    session_start();
    updateLastSeen($dbh, $_SESSION["userId"], 1);
    session_destroy();
    header("location:../login/login.php");
    exit;
?>