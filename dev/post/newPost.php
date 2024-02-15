<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../includes/style.css" />
    <script src="categoryScript.js"></script>
    <link rel="stylesheet" href="../includes/scrollableMenu.css">
    <link rel="icon" href="../nfa-icon.png" type="image/x-icon" />
    <title>NFA - New Post</title>
</head>

<body>
    <?php
    session_start();
    require_once("../includes/utils.php");
    require_once("../includes/database.php");
    updateLastSeen($dbh, $_SESSION["userId"]);
    unsetSearchKey();
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
            <div class="row col-12 col-lg-8 mx-auto d-block">
                <section>
                    <h2>New Post</h2>
                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="new-post-form" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="title" class="form-label">Choose Title:</label>
                            <input id="title" class="form-control" type="text" name="title" placeholder="Post Title" required/> 
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Choose notes:</label>
                            <input type="file" class="form-control" name="files" id="files" required/>
                        </div>

                        <div class="mb-3">
                            <label for="preview">Choose preview image:</label>
                            <input type="file" class="form-control" name="preview" id="preview" accept="image/*" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Write Description:</label>
                            <textarea class="form-control" name="description" id="description" cols="50" rows="6" form="new-post-form" placeholder="Description..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category-dropdown">Select category:</label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="category-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Choose category
                                </button>
                                <div class="dropdown-menu p-1" aria-labelledby="category-dropdown">
                                    <div class="container d-flex">
                                        <label for="category-search" hidden>Search categories</label>
                                        <input type="text" name="categorySearch" id="category-search" class="form-control" placeholder="Search/Create" />
                                        <a class="btn btn-utility-contrast btn-secondary ms-1" role="button" id="create-ctg-btn">Create</a>
                                    </div>
                                    <div class="container mt-2 scrollable-menu">
                                        <?php
                                        $query = "SELECT * FROM category";
                                        $categories = $dbh->execQuery($query);

                                        foreach ($categories as $cat) {
                                        ?>
                                            <a class="dropdown-item btn-primary rounded my-1" role="button" id="cat-<?php echo ($cat["IdCategory"]); ?>"><?php echo ($cat["Description"]); ?></a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" id="selected-category" name="category" />
                            </div>
                            <span class="badge border rounded-pill text-bg-primary d-none" id="category-badge">
                                <span class="m-0" id="category-description"></span>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="reset" class="form-label" hidden>Clear</label>
                            <input id="reset" type="reset" class="btn btn-danger confirm-button" value="Clear" />
                            <label for="submit" class="form-label" hidden>Post</label>
                            <input id="submit" type="submit" class="btn btn-success" name="submit" value="Post" />
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

        header("location:../profile/profilePage.php");
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
