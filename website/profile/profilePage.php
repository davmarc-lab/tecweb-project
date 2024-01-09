<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <title>Profile</title>
</head>
<body>
    <?php
    require_once("../includes/database.php");
    include_once("../includes/utils.php");
    session_start();
    if (!isset($_SESSION["userId"])) {
        // login not done
        header("location:../login/login.php");
    }
    $userId = $_SESSION["userId"];
    $user = $dbh->execQuery("SELECT * FROM utente WHERE utente.IdUser=$userId")[0];
    $posts = $dbh->execQuery("SELECT * FROM post WHERE post.IdUser=$userId");

    include_once("../includes/navbar.php");
    $navbar = new Navbar("../");
    $navbar->drawNavbar("Profile");
    ?>
    <div class="container-fluid overflow-hidden px-0">
        <main class="p-2">
            <div class="row justify-content-between">
                <section class="col-md-6 col-12">
                    <section class="py-3">
                        <i class="bi bi-person-fill fs-1"></i>
                        <a href="editProfile.php" role="button" class="btn btn-outline-success d-md-none">Edit</a>
                    </section>
                    <section class="pb-5">
                        <ul class="list-group">
                            <li class="my-2"><strong><?php echo $user["Username"]; ?></strong></li>
                            <li class="my-2"><strong><?php echo $user["Name"]." ".$user["Surname"]; ?></strong></li>
                            <li class="my-2"><?php echo $user["Description"]; ?></li>
                        </ul>
                    </section>
                    <section>
                        <?php foreach($posts as $userPost) { ?>
                        <div class="card border-1 mt-2 p-2" style="width: auto;">
                            <img src="../search/test.jpg" class="card-img-top rounded" alt="Image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $userPost["Title"]; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $userPost["Description"]; ?>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                    </section>
                </section>
                <section class="col-5 d-none d-md-block">
                    <?php include_once("editProfile.php"); ?>
                </section>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
