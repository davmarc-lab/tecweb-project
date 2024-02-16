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
    //header("location:../signup.php?error=2");
    echo "error2";
    exit;
} else {
    if (isNotValid($username)) {
        //header("location:../signup.php?error=3");
        echo "error3";
        exit;
    } else {
        $queryCheck = "SELECT * FROM member WHERE email = '$email' OR username = '$username';";
        $res = $dbh->execQuery($queryCheck);
        $numRows = count($res);
        if ($numRows > 0) {
            if ($username == $res[0]['Username']) {
                //header("location:../signup.php?error=4");
                echo "error4";
                return;
            } else if ($email == $res[0]['Email']) {
                //header("location:../signup.php?error=5");
                echo "error5";
                exit;
            }
        } else {
            if ($password === $passwordRep) {
                if (isset($_FILES['files'])) {
                    $uploadDir = "uploads/";
                    $targetDir = $HOME_DIR . $uploadDir;
                    $mediaId = insertImage($dbh, $uploadDir, $targetDir);
                    unset($_FILES["files"]);
                } else {
                    $mediaId = 19;
                }
                register($name, $surname, $username, $email, $password, $mediaId);
            } else {
                //header("location:../signup.php?error=1");
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
    //header("location:../login.php");
    echo "success";
}

function isNotValid($test)
{
    return preg_match('/^[a-zA-Z0-9_]*$/', $test) === 0;
}
