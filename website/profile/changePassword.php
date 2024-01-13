<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../includes/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="profile_script/popupErrorChangePsw.js"></script>
    <script src="profile_script/passwordVisibility.js"></script>

    <title>Change password</title>
</head>
<body>
    <?php
    include_once("../includes/navbar.php");
    $bar = new Navbar("../");
    $bar->drawNavbar("Change password");
    ?>
    <section>
        <div class="container-fluid d-flex align-items-center justify-content-center my-5">
            <div class="row">
                <div class="col-12">
                    <a href="editProfile.php" role="button" class="btn btn-utility mb-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <form action="changePasswordQuery.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h1>Change your password</h1>
                            </div>
                        </div>
                        <div id="insertOld">
                            <label for="inputOldPassword" class="form-label">Old password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="inputOldPassword" name="oldPassword" class="form-control password-field" placeholder="Old password" />
                                <span class="input-group-text toggle-password">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                            <label for="submitOld" class="form-label" hidden>Change</label>
                            <input id="submitOld" type="submit" class="btn btn-primary m-2" name="submitOld" value="Change" />
                        </div>
                        <div id="insertNew" hidden>
                            <label class="form-label" for="inputNewPassword">New password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="inputNewPassword" name="newPassword" class="form-control password-field" placeholder="New password"/>
                                <span class="input-group-text toggle-password">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                            <label class="form-label" for="inputRepeatPassword">Repeat new password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="inputRepeatPassword" name="repeatPassword" class="form-control password-field" placeholder="Repeat new password"/>
                                <span class="input-group-text toggle-password">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                            <label for="submit" class="form-label" hidden>Save</label>
                            <input id="submit" type="submit" class="btn btn-success m-2" name="submit" value="Save"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>