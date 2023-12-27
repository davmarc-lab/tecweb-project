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
    if (!isset($_SESSION["id"])) {
        // login not done
        // header("location:../login/login.php");
    }

    // login already done
    if (!isset($_POST["submit"])) {
        print_r($dbh->execQuery("SELECT * FROM utente"));
    ?>
    <div class="container-fluid">
        <!-- vertical navbar -->
        <div class="row d-flex align-items-center">
            <div class="col-3 bg-info-subtle">
                <ul class="nav text-center flex-column justify-content-center min-vh-100">
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

            <div class="col-7">
                <section>
                    <h2>New Post</h2>
                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="newPostForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Choose Title:</label>
                            <input id="title" class="form-control" type="text" name="title" placeholder="Post Title" required />
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Choose notes:</label>
                            <input type="file" class="form-control" name="files" id="files" multiple required/>
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
                            <input type="text" class="form-control" name="categories" placeholder="Search categories" id="categories" required/>
                        </div>

                        <div class="mb-3">
                            <label for="reset" class="form-label" hidden>Clear</label>
                            <input id="reset" type="reset" class="btn btn-outline-danger" value="Clear" />
                            <label for="submit" class="form-label" hidden>Post</label>
                            <input id="submit" type="submit" class="btn btn-outline-success" name="submit" value="Post" />
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <?php } else {      // submit already done
        print_r($dbh->execQuery("SELECT * FROM utente"));
    }?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>