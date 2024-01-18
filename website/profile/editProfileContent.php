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
    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$userId")[0];
    ?>
    <div class="container-fluid overflow-hidden p-3">
        <div class="row justify-content-between fix-bottom edit-profile-box">
            <section class="col-12 p-4">
                <a id="edit-back-button" href="profilePage.php" role="button" class="btn btn-utility mb-3" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
                <a id="change-password-button" href="changePassword.php" role="button" class="btn btn-utility mb-3" title="Change password">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                </a>
                <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="edit-profile-form" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="input-image" class="form-label">Upload new icon:</label>
                        <input type="file" name="files" id="input-image" accept="image/*" class="form-control" />
                    </div>
                    <div class="mb-2">
                        <label for="input-name" class="form-label">Name:</label>
                        <input type="text" id="input-name" name="name" class="form-control" value="<?php echo $user["Name"]; ?>" />
                    </div>
                    <div class="mb-2">
                        <label for="input-surname" class="form-label">Surname</label>
                        <input type="text" id="input-surname" name="surname" class="form-control" value="<?php echo $user["Surname"]; ?>" />
                    </div>
                    <div class="mb-2">
                        <label for="input-username" class="form-label">Username</label>
                        <input type="text" id="input-username" name="username" class="form-control" value="<?php echo $user["Username"]; ?>" />
                    </div>
                    <div class="mb-2">
                        <label for="input-email" class="form-label">Email</label>
                        <input type="email" id="input-email" name="email" class="form-control" value="<?php echo $user["Email"]; ?>" />
                    </div>
                    <div class="mb-2">
                        <label for="input-description" class="form-label">Description *</label>
                        <textarea id="input-description" name="description" class="form-control" rows="4" form="edit-profile-form"><?php echo $user["Description"]; ?></textarea>
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
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $description = empty($_POST["description"]) ? NULL : $_POST["description"];
        $mediaId = $dbh->execQuery("SELECT IdMedia FROM member WHERE IdUser='$userId';")[0]["IdMedia"];
        if ($_FILES["files"]["size"] != 0) {
            $uploadDir = "uploads/";
            $targetDir = $HOME_DIR . $uploadDir;
            $mediaId = insertImage($dbh, $uploadDir, $targetDir);
        }
        $query = "UPDATE member 
            SET Name='$name', Surname='$surname', Username='$username', Email='$email', Description='$description', IdMedia='$mediaId' 
            WHERE member.IdUser='$userId'";
        $res = $dbh->execQuery($query);
        unset($_FILES["files"]);

        echo "<meta http-equiv='refresh' content='0'>";
    }
?>