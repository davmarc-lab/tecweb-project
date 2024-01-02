<?php
require_once("../../includes/database.php");
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
                register($name, $surname, $username, $email, $password);
            } else {
                header("location:../signup.php?error=1");
            }
        }
    }
}

function register($name, $surname, $username, $email, $password) {
    global $dbh;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO utente (Name, Surname, Username, Email, Password) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash');";
    $res = $dbh->execQuery($query);
    if (!$res) {
        header("location:../signup.php?error=4");
    }
    unset($_SESSION['oldValuesSignup']);
    header("location:../login.php");
}

function isNotValid($test) {
    return preg_match('/^[a-zA-Z0-9_]*$/', $test) === 0;
}

?>
