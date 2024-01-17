<?php

$HOME_DIR;

enum NotificationType: string
{
    case LIKE = "Like";
    case COMMENT = "Comment";
    case FOLLOWER = "Follower";
}

function getHomeDirectory() {
    $parts = explode(DIRECTORY_SEPARATOR, getcwd());

    $index = array_search('website', $parts);

    return implode(DIRECTORY_SEPARATOR, array_slice($parts, 0, $index + 1));
}

function drawLinkUsername($username, $userId, $targetLink) {
    return "<a href=\"$targetLink?user=$userId\">@$username</a>";
}

function drawLinkUsernameDropdown($username, $userId, $targetLink) {
    return "<a class=\"dropdown-item\" href=\"$targetLink?user=$userId\">@$username</a>";
}

function insertImage($dbh, $uploadDir, $targetDir) {
    session_start();
    $_SESSION["debug"] = [
        "chiamata" => "ok", 
    ];
    $mediaId = 0;
    if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {
        $fileName = basename($_FILES["files"]["name"]);
        $fileName = date("Ymd") . date("His") . $fileName;
        $fileName = str_replace(" ", "_", $fileName);
        $targetPath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["files"]["tmp_name"], $targetPath)) {
            $mediaPath = $uploadDir . $fileName;
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

$HOME_DIR = getHomeDirectory() . DIRECTORY_SEPARATOR;

function getHomeDirectoryValue() {
    $HOME_DIR = getHomeDirectory() . DIRECTORY_SEPARATOR;
    return $HOME_DIR;
}

function checkUserOnline($dbh, $id) {
    $query = "SELECT *, IFNULL(TIMESTAMPDIFF(MINUTE, lastseen, NOW()), -1) AS diff_minutes FROM utente WHERE IdUser = $id AND (lastseen IS NULL OR TIMESTAMPDIFF(MINUTE, lastseen, NOW()) > 15)";
    $test = $dbh->execQuery($query);
    return (!(count($test) > 0) || $test == -1);
}

function getUserMail($dbh, $id) {
    $query = "SELECT Email FROM utente WHERE IdUser = '{$id}';";
    $res = $dbh->execQuery($query);
    return $res[0]['Email'];
}

function sendEmailNotification($dst, $subject, $message) {
    $from = "noteforall2@gmail.com";
    $headers = ['From' => $from];
    mail($dst, $subject, $message, $headers);
}

function updateLastSeen($dbh, $id, $delete = -1) {
    if ($delete == -1) {
        $query = "UPDATE utente SET lastseen = NOW() WHERE IdUser = $id";
    } else {
        $query = "UPDATE utente SET lastseen = NULL WHERE IdUser = $id";
    }
    $dbh->execQuery($query);
}

function unsetSearchKey() {
    if (isset($_SESSION["search_result"]["post"])) {
        unset($_SESSION["search_result"]["post"]);
        unset($_SESSION["search_result"]["profile"]);
    }
}

function getCategory($dbh, $post) {
    if ($post['IdCategory'] != NULL) {
        $queryCategory = "SELECT Description FROM category WHERE IdCategory = {$post['IdCategory']};";
        $category = $dbh->execQuery($queryCategory)[0]["Description"];
    } else {
        $category = NULL;
    }
    return $category;
}

function getAllCategories($dbh) {
    $query = "SELECT DISTINCT(IdCategory), Description FROM category";
    $categories = $dbh->execQuery($query);
    return $categories;
}
