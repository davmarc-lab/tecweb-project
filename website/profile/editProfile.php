<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../includes/style.css">
    <script src="profile_script/editProfileResize.js"></script>
    <script src="../includes/themeScript.js"></script>

    <title>Document</title>
</head>

<body>
    <?php
    require_once("../includes/database.php");
    include_once("../includes/utils.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    updateLastSeen($dbh, $_SESSION["userId"]);

    if (!isset($_SESSION["userId"])) {
        // login not done
        header("location:../login/login.php");
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM utente WHERE utente.IdUser=$userId")[0];
    ?>
    <div class="container-fluid overflow-hidden p-3">
        <main>
            <div id="edit-profile-box-id" class="row justify-content-between fix-bottom">
                <section class="col-12 p-4">
                    <a id="back-button" href="profilePage.php" role="button" class="btn btn-utility mb-3" title="Go back">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <a id="change-password-button" href="changePassword.php" role="button" class="btn btn-utility mb-3" title="Change password">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="editProfileForm" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="inputImage" class="form-label">Upload new icon:</label>
                            <input type="file" name="files" id="inputImage" accept="image/*" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <label for="inputName" class="form-label">Name:</label>
                            <input type="text" id="inputName" name="name" class="form-control" value="<?php echo $user["Name"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputSurname" class="form-label">Surname</label>
                            <input type="text" id="inputSurname" name="surname" class="form-control" value="<?php echo $user["Surname"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" id="inputUsername" name="username" class="form-control" value="<?php echo $user["Username"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" id="inputEmail" name="email" class="form-control" value="<?php echo $user["Email"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputDescription" class="form-label">Description *</label>
                            <textarea id="inputDescription" name="description" class="form-control" rows="4" form="editProfileForm"><?php echo $user["Description"]; ?></textarea>
                        </div>
                        <div class="d-flex">
                            <label for="reset" class="form-label" hidden>Cancel</label>
                            <input id="reset" type="reset" class="btn btn-danger ms-auto m-2" value="Cancel" />
                            <label for="submit" class="form-label" hidden>Save</label>
                            <input id="submit" type="submit" class="btn btn-success m-2" name="submit" value="Save" />
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $description = empty($_POST["description"]) ? NULL : $_POST["description"];
        $mediaId = $dbh->execQuery("SELECT IdMedia FROM utente WHERE IdUser='$userId';")[0]["IdMedia"];
        if (isset($_FILES["files"])) {
            $uploadDir = "uploads/";
            $targetDir = $HOME_DIR . $uploadDir;
            $mediaId = insertImage($dbh, $uploadDir, $targetDir);
        }
        $query = "UPDATE utente 
            SET Name='$name', Surname='$surname', Username='$username', Email='$email', Description='$description', IdMedia='$mediaId' 
            WHERE utente.IdUser='$userId'";
        $res = $dbh->execQuery($query);
        print_r($res);
        unset($_FILES["files"]);

        echo "<meta http-equiv='refresh' content='0'>";
    } ?>
</body>

</html>