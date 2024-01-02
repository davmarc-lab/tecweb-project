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
if ($password === $passwordRep) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO utente (Name, Surname, Username, Email, Password) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash');";
    $res = $dbh->execQuery($query);
    print_r($res);
    $_SESSION['oldValuesSignup'] = [
        "name" => "",
        "surname" => "",
        "email" => "",
        "username" => "",
    ];
    header("location:../login.php");
} else {
    header("location:../signup.php?error=1");
}

?>
