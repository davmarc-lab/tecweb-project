<?php
    require_once("../../includes/database.php");
    include_once("../../includes/utils.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$userId")[0];

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $description = empty($_POST["description"]) ? NULL : $_POST["description"];
    $mediaId = $dbh->execQuery("SELECT IdMedia FROM member WHERE IdUser='$userId';")[0]["IdMedia"];
    if ($_FILES["icon"]["size"] != 0) {
        $uploadDir = "uploads/";
        $targetDir = "../../" . $uploadDir;
        $mediaId = insertImage($dbh, $uploadDir, $targetDir);
    }
    $query = "UPDATE member 
                SET Name='$name', Surname='$surname', Username='$username', Email='$email', Description='$description', IdMedia='$mediaId' 
                WHERE member.IdUser='$userId'";
    $res = $dbh->execQuery($query);
    unset($_FILES["icon"]);
?>
