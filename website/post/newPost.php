<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>New Post</title>
</head>

<body>
    <?php

    require_once("../includes/database.php");
    session_start();
    if (!isset($_SESSION["userId"])) {
        // login not done
        header("location:../login/login.php");
    }

    // login already done
    if (!isset($_POST["submit"])) {
    ?>
        <div class="row m-auto mb-4">
            <?php
            include_once("../includes/navbar.php");
            $bar = new Navbar("../");
            $bar->drawNavbar("New Post");
            ?>
        </div>
        <div class="container-fluid">
            <div class="row col-8 mx-auto d-block">
                <section>
                    <h2>New Post</h2>
                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="newPostForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Choose Title:</label>
                            <input id="title" class="form-control" type="text" name="title" placeholder="Post Title" /> <!-- required -->
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Choose notes:</label>
                            <input type="file" class="form-control" name="files" id="files" />
                        </div>

                        <div class="mb-3">
                            <label for="preview">Choose preview image:</label>
                            <input type="file" class="form-control" name="preview" id="preview" accept="image/*" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Write Description:</label>
                            <textarea class="form-control" name="description" id="description" cols="50" rows="6" form="newPostForm" placeholder="Description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="categories">Choose Categories:</label>
                            <input type="text" class="form-control" name="categories" placeholder="Search categories" id="categories" />
                        </div>

                        <div class="mb-3">
                            <label for="reset" class="form-label" hidden>Clear</label>
                            <input id="reset" type="reset" class="btn btn-outline-danger confirm-button" value="Clear" />
                            <label for="submit" class="form-label" hidden>Post</label>
                            <input id="submit" type="submit" class="btn btn-outline-success" name="submit" value="Post" />
                        </div>
                    </form>
                </section>

            </div>
        </div>
    <?php } else {      // submit already done
        include_once("../includes/utils.php");
        $uploadDir = "uploads/";
        $targetDir = $HOME_DIR . $uploadDir;
        $mediaId = 0;

        if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {
            $fileName = basename($_FILES["files"]["name"]);
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
        $categories = $_POST["categories"];
        $idUser = $_SESSION["userId"];
        $idMedia = $mediaId;       // last id inserted
        $idPreview = $previewId;

        // NumberVote and NumberComment are initially 0
        $query = "INSERT INTO post (Title, Description, NumberVote, NumberComment, IdUser, IdMedia" .
            ($previewId == NULL ? ")" : ", IdPreview)") .
            " VALUES('$title', '$description', 0, 0, $idUser, $idMedia" .
            ($previewId == NULL ? ");" : ", $idPreview);");
        $res = $dbh->execQuery($query);

        header("location:../profile/profilePage.php");
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>