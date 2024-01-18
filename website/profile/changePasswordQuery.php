<?php
    require_once("../includes/database.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["userId"])) {
        // login not done
        header("location:../login/login.php");
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$userId")[0];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["submitOld"])) {
            if (!empty($_POST["oldPassword"])) {
                if (password_verify($_POST["oldPassword"], $user["Password"])) {
                    header("location: changePassword.php?error=0");
                } else {
                    header(("location: changePassword.php?error=1"));
                }
                unset($_POST["oldPassword"]);
            }
        }
        if (isset($_POST["submit"])) {
            $newPassword = $_POST["newPassword"];
            $passwordRep = $_POST["repeatPassword"];
            if ($newPassword === $passwordRep) {
                $finalPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE member SET Password = '$finalPassword' WHERE IdUser='$userId'";
                $res = $dbh->execQuery($query);

                header("location: profilePage.php");
            } else {
                unset($_POST["newPassword"]);
                unset($_POST["repeatPassword"]);
                header("location: changePassword.php?error=2");
            }
        } else {
            echo("NON DEVI PREMERE INVIO!");
        }
    }
?>