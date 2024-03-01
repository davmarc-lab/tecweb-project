<?php
    require_once("../../includes/database.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$userId")[0];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST["oldPassword"])) {
            if (password_verify($_POST["oldPassword"], $user["Password"])) {
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }
?>
