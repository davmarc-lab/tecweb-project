<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../colors.css">
    <title>New Post</title>
</head>

<body>
    <?php
    require_once("../includes/database.php");
    if (!isset($_SESSION["userId"])) {
        // login not done
        // header("location:../login/login.html");
    }

    // login already done
    if (!isset($_POST["submit"])) {
    ?>
        <div class="container-fluid">
            <!-- vertical navbar -->
            <div class="row d-flex align-items-center">
                <div class="col-2 bg-info-subtle">
                    <nav class="navbar nav navbar-expand-lg text-center flex-column justify-content-center min-vh-100">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#links" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="navbar-collapse collapse" id="links">
                            <ul class="list-unstyled">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Search</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">New Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Profile</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="col-7">
                    <section>
                        <h2>New Post</h2>
                        <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="newPostForm">
                            <div class="mb-3">
                                <label for="title" class="form-label">Choose Title:</label>
                                <input id="title" class="form-control" type="text" name="title" placeholder="Post Title" />         <!-- required -->
                            </div>

                            <div class="mb-3">
                                <label for="files" class="form-label">Choose notes:</label>
                                <input type="file" class="form-control" name="files[]" id="files" multiple />
                            </div>

                            <div class="mb-3">
                                <label for="preview">Choose preview image:</label>
                                <input type="file" class="form-control" name="previewImage" id="preview" accept="image/*" />
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
        </div>
    <?php } else {      // submit already done
        $title = $_POST["title"];
        $files = $_POST["files"];
        /* print_r($files); */
        $preview = $_POST["previewImage"];
        $description = empty($_POST["description"]) ? "" : $_POST["description"];
        $categories = $_POST["categories"];
        /* $idUser = $_SESSION["userId"]; */
        $idUser = $_SESSION["userid"];
        $idMedia = 1;       // last id inserted
        $idPreview = empty($_POST["previewImage"]) ? "NULL" : $_POST["previewImage"];
        
        // NumberVote and NumberComment are initially 0
        $query = "INSERT INTO post (Title, Description, NumberVote, NumberComment, IdUser, IdMedia, IdPreview) VALUES('$title', '$description', 0, 0, $idUser, $idMedia, $idPreview);";
        $res = $dbh->execQuery($query);
        print_r($res);

        header("location:../profilePage/profilePage.php");
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
