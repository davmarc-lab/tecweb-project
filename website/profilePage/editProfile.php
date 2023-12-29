<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <title>Document</title>
</head>
<body>
    <?php
    require_once("../includes/database.php");
    if (!isset($_SESSION["IdUser"])) {
        // login not done
        header("location:../login/login.php");
    }
    $userId = $_SESSION["IdUser"];
    $user = $dbh->execQuery("SELECT * FROM utente WHERE utente.IdUser=$userId")[0];

    // login already done
    if (!isset($_POST["submit"])) {
    ?>
        <div class="container-fluid overflow-hidden px-0">
            <main>
                <div class="row justify-content-between">
                    <section class="col-md-6 d-none d-md-block">
                        <?php include_once("profilePage.php"); ?>
                    </section>
                    <section class="col-12 bg-light p-4">
                        <a href="profilePage.php" role="button" class="btn btn-light d-md-none mb-3">
                            <img src="../icons/backIcon2.png" class="p-0" alt="back" />
                        </a>
                        <a href="#" role="button" class="btn btn-light d-md-none mb-3">
                            <img src="../icons/edit.png" class="p-0" alt="edit icon" />
                        </a>
                        <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="editProfileForm">
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
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" id="inputPassword" name="password" class="form-control" value="Password" />
                            </div>
                            <div class="mb-2">
                                <label for="inputPassword" class="form-label">Repeat password</label>
                                <input type="password" id="inputPassword" name="repeatPassword" class="form-control" value="Repeat password" />
                            </div>
                            <div class="mb-2">
                                <label for="inputDescription" class="form-label">Description *</label>
                                <textarea id="inputDescription" name="description" class="form-control" rows="4" value="<?php echo $user["Description"]; ?>"></textarea>
                            </div>
                            <div class="d-flex">
                                <button type="reset" class="btn btn-outline-danger ms-auto m-2">Cancel</button>
                                <button type="submit" class="btn btn-outline-success m-2">Save</button>
                            </div>
                        </form>
                    </section>
                </div>
            </main>
        </div>
    <?php } else {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"]
        $email = $_POST["email"];
        $password = $_POST["repeatPassword"]; //to modify!
        $description = empty($_POST["description"]) ? "" : $_POST["description"];

        $query = "UPDATE utente 
            SET Name='$name', Surname='$surname', Username='$username', Email='$email', Password='$password', Description='$description' 
            WHERE IdUser=$userId";
        $res = $dbh->execQuery($query);
        print_r($res);
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
