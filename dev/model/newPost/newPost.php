<?php
    session_start();
    require_once("../includes/utils.php");
    require_once("../includes/database.php");
    $uploadDir = "uploads/";
        $targetDir = $HOME_DIR . $uploadDir;
        $mediaId = 0;

        if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {
            $fileName = basename($_FILES["files"]["name"]);
            $fileName = str_replace(" ", "_", $fileName);
            $targetPath = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["files"]["tmp_name"], $targetPath)) {
                $mediaPath = $uploadDir . $fileName;
                $query = "INSERT INTO media (FileName, FilePath) VALUES('$fileName', '$mediaPath')";
                $res = $dbh->execQuery($query);
                $mediaId = $dbh->getDataBaseController()->insert_id;
                if ($res == 0) {
                    echo ("Failed INSERT query.");
                }
            } else {
                echo ("Error UPLOAD, cannot upload the file.");
            }
        } else {
            echo ("Error PREPARE, cannot prepare the file.");
        }

        $previewId = 0;
        if ($_FILES["preview"]["size"] == 0) {
            $previewId = NULL;
        } else {
            if (isset($_FILES["preview"]) && $_FILES["preview"]["error"] == 0) {
                $fileName = basename($_FILES["preview"]["name"]);
                $fileName = str_replace(" ", "_", $fileName);
                $targetPath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["preview"]["tmp_name"], $targetPath)) {
                    $mediaPath = $uploadDir . $fileName;
                    $query = "INSERT INTO media (FileName, FilePath) VALUES('$fileName', '$mediaPath')";
                    $res = $dbh->execQuery($query);
                    $previewId = $dbh->getDataBaseController()->insert_id;
                    if ($res == 0) {
                        echo ("Failed INSERT query.");
                    }
                } else {
                    echo ("Error UPLOAD, cannot upload the file.");
                }
            } else {
                echo ("Error PREPARE, cannot prepare the file.");
            }
        }

        $title = $_POST["title"];
        $description = empty($_POST["description"]) ? "" : $_POST["description"];
        $description = str_replace("\\", "\\\\", $description);
        $description = str_replace("'", "\\'", $description);
        print_r($description);
        $idUser = $_SESSION["userId"];
        $idMedia = $mediaId;       // last id inserted
        $idPreview = $previewId;
        $idCategory = isset($_POST["category"]) ? $_POST["category"] : NULL;

        // NumberVote and NumberComment are initially 0
        $currentDate = date("Y-m-d H:i:s");
        $query = "INSERT INTO post (Date, Title, Description, NumberVote, NumberComment, IdUser, IdMedia" .
            ($previewId == NULL ? "" : ", IdPreview") .
            ($idCategory == NULL ? "" : ", IdCategory") .
            ")" .
            " VALUES('$currentDate', '$title', '$description', 0, 0, $idUser, $idMedia" .
            ($previewId == NULL ? "" : ", $idPreview") .
            ($idCategory == NULL ? "" : ", $idCategory") .
            ");";
        $res = $dbh->execQuery($query);
?>