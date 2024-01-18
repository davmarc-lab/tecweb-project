<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../includes/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="profile_script/popupErrorChangePsw.js"></script>
    <script src="profile_script/passwordVisibility.js"></script>
    <script>
        // remove event when enter key is pressed
        $(document).keypress(
            function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
    </script>

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
                    <a href="editProfile.php" role="button" class="btn btn-utility-contrast mb-3" title="Go back">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    <form action="changePasswordQuery.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h1>Change your password</h1>
                            </div>
                        </div>
                        <div id="insert-old">
                            <label for="input-old-password" class="form-label">Old password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="input-old-password" name="oldPassword" class="form-control password-field" placeholder="Old password" />
                                <span class="input-group-text toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </span>
                            </div>
                            <label for="submit-old" class="form-label" hidden>Change</label>
                            <input id="submit-old" type="submit" class="btn btn-primary m-2" name="submitOld" value="Change" />
                        </div>
                        <div id="insert-new" hidden>
                            <label class="form-label" for="input-new-Password">New password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="input-new-Password" name="newPassword" class="form-control password-field" placeholder="New password" />
                                <span class="input-group-text toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </span>
                            </div>
                            <label class="form-label" for="input-repeat-password">Repeat new password</label>
                            <div class="input-group mb-2">
                                <input type="password" id="input-repeat-password" name="repeatPassword" class="form-control password-field" placeholder="Repeat new password" />
                                <span class="input-group-text toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </span>
                            </div>
                            <label for="submit" class="form-label" hidden>Save</label>
                            <input id="submit" type="submit" class="btn btn-success m-2" name="submit" value="Save" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>