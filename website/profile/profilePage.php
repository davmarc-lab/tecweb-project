<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="profile_script/followScript.js"></script>

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

    $showEdit = true;
    $dstUser = $_SESSION["userId"];
    if (isset($_GET["user"]) && ($dstUser != $_GET["user"])) {
        $dstUser = $_GET["user"];
        $showEdit = false;
    }

    $user = $dbh->execQuery("SELECT * FROM utente WHERE utente.IdUser=$dstUser")[0];
    $posts = $dbh->execQuery("SELECT * FROM post WHERE post.IdUser=$dstUser");

    include_once("../includes/navbar.php");
    $navbar = new Navbar("../");
    $navbar->drawNavbar("Profile");
    ?>
    <div class="container-fluid overflow-hidden px-0">
        <main class="p-2">
        <?php
        if ($showEdit) {
        ?>
            <div class="row justify-content-between">
                <div class="overflow-y-auto overflow-x-hidden col-md-6 col-12">
        <?php
        } else {
        ?>
            <div class="row justify-content-center">
                <div class="overflow-y-auto overflow-x-hidden col-10">
        <?php
        }
        ?>
                    <section>
                        <section class="py-3">
                            <i class="bi bi-person-fill fs-1"></i>
                            <?php
                            if ($showEdit) {
                            ?>
                                <a href="editProfile.php" role="button" class="btn btn-outline-success d-md-none">Edit</a>
                            <?php
                            } else {
                                // checks if the user follow.
                                $query = "SELECT * FROM follow WHERE IdSrc = {$_SESSION['userId']}
                                        AND IdDst = $dstUser";
                                $res = $dbh->execQuery($query);
                                $query = "SELECT NumberFollower from utente WHERE IdUser = $dstUser";
                                $numFollower = $dbh->execQuery($query)[0]['NumberFollower'];
                            ?>
                                <a id="followButton" onclick="followUser(<?php echo ($_SESSION['userId'] . ', ' . $dstUser); ?>)" role="button" class="btn btn-outline-primary <?php echo(sizeof($res) != 0 ? "d-none" : "") ?>">Follow</a>
                                <a id="unfollowButton" onclick="unfollowUser(<?php echo ($_SESSION['userId'] . ', ' . $dstUser); ?>)" role="button" class="btn btn-outline-primary <?php echo(sizeof($res) == 0 ? "d-none" : "") ?>">Unfollow</a>
                                <h2 style="display: inline-block; margin-left: 40px;">Follower: <?php echo $numFollower ?></h2>
                            <?php
                            }
                            ?>
                        </section>
                        <section class="pb-5">
                            <ul class="list-group">
                                <li class="my-2"><strong><?php echo $user["Username"]; ?></strong></li>
                                <li class="my-2"><strong><?php echo $user["Name"] . " " . $user["Surname"]; ?></strong></li>
                                <li class="my-2"><?php echo $user["Description"]; ?></li>
                            </ul>
                        </section>
                        <section>
                            <?php foreach ($posts as $userPost) { 
                                $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$userPost['IdPreview']};";
                                $previewPath = $dbh->execQuery($queryPreview)[0]['FilePath'];
                                $previewPath = "../" . $previewPath;
                                ?>
                                <div class="card border-1 mt-2 p-2" style="width: auto;">
                                    <img src="<?php echo $previewPath?>" class="card-img-top rounded" alt="Image">
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
                </div>
                <?php
                if ($showEdit) {
                ?>
                    <div class="position-fixed top-20 end-0 pe-5 col-5 d-none d-md-block">
                        <section>
                            <?php include_once("editProfile.php"); ?>
                        </section>
                    </div>
                <?php
                }
                ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>