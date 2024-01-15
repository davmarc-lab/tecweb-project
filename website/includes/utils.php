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
    return "<a class=\"text-decoration-none\" href=\"$targetLink?user=$userId\">@$username</a>";
}

function insertImage($dbh, $uploadDir, $targetDir) {
    session_start();
    $_SESSION["debug"] = [
        "chiamata" => "ok", 
    ];
    $mediaId = 0;
    if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {
        $fileName = basename($_FILES["files"]["name"]);
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
