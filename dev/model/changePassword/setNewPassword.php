<?php
    require_once("../../includes/database.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$userId")[0];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $newPassword = $_POST["newPassword"];
        $passwordRep = $_POST["repeatPassword"];
        if ($newPassword === $passwordRep) {
            $finalPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE member SET Password = '$finalPassword' WHERE IdUser='$userId'";
            $res = $dbh->execQuery($query);
            //header("location: profilePage.php");
            echo 'ok';
        } else {
            unset($_POST["newPassword"]);
            unset($_POST["repeatPassword"]);
            //header("location: changePassword.php?error=2");
            echo 'error';
        }
    }
?>
