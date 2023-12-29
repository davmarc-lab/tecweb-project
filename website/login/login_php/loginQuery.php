<?php
    require_once("../../includes/database.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM utente WHERE Email='$email';";
    $res = $dbh->execQuery($query);
    $numRows = count($res);
    if ($numRows > 0) {
        $dbPassword = $res[0]['Password'];
        if (password_verify($password, $dbPassword)) {
            session_start();
            $_SESSION["userId"] = $res[0]['IdUser'];
            header("location:../../index.php");
        }
    }  else {
        // Utente non trovato, mostra un popup con un messaggio
        header("location:../login.php?error=1");
    }
    
?>