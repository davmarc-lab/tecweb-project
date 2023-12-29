<?php
require_once("../../includes/database.php");
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordRep = $_POST['passwordRepeat'];
if ($password === $passwordRep) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO utente (Name, Surname, Username, Email, Password) VALUES ('$name', '$surname', '$username', '$email', '$passwordHash');";
    $res = $dbh->execQuery($query);
    print_r($res);
    header("location:../login.php");
} else {
    header("location:../signup.php?error=1");
}

?>
