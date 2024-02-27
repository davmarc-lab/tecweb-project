<?php
require_once("../../includes/database.php");
include_once("../../includes/utils.php");
session_start();
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordRep = $_POST['passwordRepeat'];

if ($password === "") {
    echo "error2";
    exit;
} else {
    if (isNotValid($username)) {
        echo "error3";
        exit;
    } else {
        $queryCheck = "SELECT * FROM member WHERE email = '$email' OR username = '$username';";
        $res = $dbh->execQuery($queryCheck);
        $numRows = count($res);
        if ($numRows > 0) {
            if ($username == $res[0]['Username']) {
                echo "error4";
                return;
            } else if ($email == $res[0]['Email']) {
                echo "error5";
                exit;
            }
        } else {
            if ($password === $passwordRep) {
                $mediaId = -1;
                if (isset($_FILES['icon']) && $_FILES["icon"]["error"] == 0) {
                    $uploadDir = "uploads/";
                    $targetDir = "../../" . $uploadDir;
                    $mediaId = insertImage($dbh, $uploadDir, $targetDir);
                    unset($_FILES["icon"]);
                } else {
                    $mediaId = 19;
                }
                //echo "Media id prima di register: " . $mediaId;
                register($name, $surname, $username, $email, $password, $mediaId);
            } else {
                echo "error1";
            }
        }
    }
}

function register($name, $surname, $username, $email, $password, $mediaId)
{
    global $dbh;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    //echo "Media id: " . $mediaId;
    $query = "INSERT INTO member (Name, Surname, Username, Email, Password, IdMedia) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash', '$mediaId');";
    $res = $dbh->execQuery($query);
    $id = mysqli_insert_id($dbh->getDataBaseController());
    $_SESSION["userId"] = $id;
    updateLastSeen($dbh, $_SESSION["userId"]);
    if (!isset($_COOKIE["theme"])) {
        setcookie("theme", "light", strtotime('+30 days'), "/");
    }
    echo "success";
}

function isNotValid($test)
{
    return preg_match('/^[a-zA-Z0-9_]*$/', $test) === 0;
}
