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
$_SESSION['oldValuesSignup'] = [
    "name" => $name,
    "surname" => $surname,
    "email" => $email,
    "username" => $username,
];

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
                print_r($_FILES);
                if (isset($_FILES['signup-image'])) {
                    $uploadDir = "uploads/";
                    $targetDir = "../../" . $uploadDir;
                    $mediaId = insertImage($dbh, $uploadDir, $targetDir);
                    unset($_FILES["signup-image"]);
                } else {
                    $mediaId = 19;
                }
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
    $query = "INSERT INTO member (Name, Surname, Username, Email, Password, IdMedia) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash', '$mediaId');";
    $res = $dbh->execQuery($query);
    unset($_SESSION['oldValuesSignup']);
    $_SESSION['oldValueLogin']['username'] = $username;
    $_SESSION["userId"] = $res[0]['IdUser'];
    updateLastSeen($dbh, $_SESSION["userId"]);
    unset($_SESSION['oldValueLogin']);
    if (!isset($_COOKIE["theme"])) {
        setcookie("theme", "light", strtotime('+30 days'), "/");
    }
    echo "success";
}

function isNotValid($test)
{
    return preg_match('/^[a-zA-Z0-9_]*$/', $test) === 0;
}
