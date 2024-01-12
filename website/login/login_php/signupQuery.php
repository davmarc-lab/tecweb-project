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
    header("location:../signup.php?error=2");
    exit;
} else {
    if (isNotValid($username)) {
        header("location:../signup.php?error=3");
        exit;
    } else {
        $queryCheck = "SELECT * FROM utente WHERE email = '$email' OR username = '$username';";
        $res = $dbh->execQuery($queryCheck);
        $numRows = count($res);
        if ($numRows > 0) {
            if ($username == $res[0]['Username']) {
                header("location:../signup.php?error=4");
                exit;
            } else if ($email == $res[0]['Email']) {
                header("location:../signup.php?error=5");
                exit;
            }
        } else {
            if ($password === $passwordRep) {
                if (isset($_POST['files'])) {
                    $uploadDir = "uploads/";
                    $targetDir = $HOME_DIR . $uploadDir;
                    $mediaId = insertImage($uploadDir, $targetDir);
                } else {
                    $mediaId = 19;
                }
                register($name, $surname, $username, $email, $password, $mediaId);
            } else {
                header("location:../signup.php?error=1");
            }
        }
    }
}

function register($name, $surname, $username, $email, $password, $mediaId)
{
    global $dbh;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO utente (Name, Surname, Username, Email, Password, IdMedia) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash', '$mediaId');";
    $res = $dbh->execQuery($query);
    if (!$res) {
        header("location:../signup.php?error=4");
    }
    unset($_SESSION['oldValuesSignup']);
    $_SESSION['oldValueLogin']['username'] = $username;
    header("location:../login.php");
}

function insertImage($uploadDir, $targetDir) {
    global $dbh;
    $mediaId = 0;
    if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {
        $fileName = basename($_FILES["files"]["name"]);
        $targetPath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["files"]["tmp_name"], $targetPath)) {
            $mediaPath = "../" . $uploadDir . $fileName;
            $query = "INSERT INTO media (FileName, FilePath) VALUES('$fileName', '$mediaPath')";
            $res = $dbh->execQuery($query);
            $mediaId = mysqli_insert_id($dbh->getDataBaseController());
            if ($res == 0) {
                echo ("Failed INSERT query.");
            }
            return $mediaId;
        } else {
            echo ("Error UPLOAD, cannot upload the file.");
        }
    } else {
        echo ("Error PREPARE, cannot prepare the file.");
    }
}

function isNotValid($test)
{
    return preg_match('/^[a-zA-Z0-9_]*$/', $test) === 0;
}
