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
    $user = $dbh->execQuery("SELECT * FROM utente WHERE utente.IdUser=1")[0];
    ?>
    <div class="container-fluid overflow-hidden px-0">
        <main>
            <div class="row justify-content-between">
                <section class="col-md-6 d-none d-md-block">
                    <?php include_once("profilePage.php"); ?>
                </section>
                <section class="col-12 bg-light p-4">
                    <a href="profilePage.php" role="button" class="btn btn-light d-md-none mb-3">
                        <img src="../icons/backIcon2.png" class="p-0" alt="" />
                    </a>
                    <form>
                        <div class="mb-2">
                            <label for="inputName">Name:</label>
                            <input type="text" id="inputName" class="form-control" value="<?php echo $user["Name"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputSurname">Surname</label>
                            <input type="text" id="inputSurname" class="form-control" value="<?php echo $user["Surname"]; ?>" />
                        </div>
                        <!--<div class="mb-2">
                            <label for="inputDate">Birth date</label>
                            <input type="date" id="inputDate" class="form-control" value="<?php echo $user["Date"]; ?>" />
                        </div>-->
                        <div class="mb-2">
                            <label for="inputEmail">Email</label>
                            <input type="email" id="inputEmail" class="form-control" value="<?php echo $user["Email"]; ?>" />
                        </div>
                        <div class="mb-2">
                            <label for="inputPassword">Password</label>
                            <input type="password" id="inputPassword" class="form-control" value="Password" />
                        </div>
                        <div class="mb-2">
                            <label for="inputPassword">Repeat password</label>
                            <input type="password" id="inputPassword" class="form-control" value="Repeat password" />
                        </div>
                        <div class="mb-2">
                            <label for="inputDescription">Description *</label>
                            <textarea id="inputDescription" class="form-control" rows="4" value="<?php echo $user["Description"]; ?>"></textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>