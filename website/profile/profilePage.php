<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../includes/style.css">
    <script src="../includes/followScript.js"></script>
    <title>Profile</title>
</head>

<body>
    <?php
    session_start();
    require_once("../includes/database.php");
    include_once("../includes/utils.php");
    updateLastSeen($dbh, $_SESSION["userId"]);
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
    $posts = $dbh->execQuery("SELECT * FROM post WHERE post.IdUser=$dstUser ORDER BY post.Date DESC");

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
                            <section class="px-3">
                                <section class="pt-3">
                                    <?php
                                    $query = "SELECT FilePath from media WHERE IdMedia = {$user['IdMedia']};";
                                    $previewPath = $dbh->execQuery($query)[0]['FilePath'];
                                    ?>
                                     <a id="back-button" href="javascript: history.go(-1)" role="button" class="btn btn-utility mb-3">
                                        <i class="bi bi-arrow-left"></i>
                                    </a>
                                    <img src="../<?php echo $previewPath ?>" alt="" class="rounded rounded-5" height="70px" width="70px" />
                                    <?php
                                    if ($showEdit) {
                                        unsetSearchKey();
                                    ?>
                                        <a href="editProfile.php" role="button" class="btn d-md-none ms-2">Edit</a>
                                    <?php
                                    } else {
                                        // checks if the user follow.
                                        $query = "SELECT * FROM follow WHERE IdSrc = {$_SESSION['userId']}
                                        AND IdDst = $dstUser";
                                        $res = $dbh->execQuery($query);
                                        $pathFollow = "'followUserQuery.php'";
                                        $pathUnfollow = "'unfollowUserQuery.php'";
                                    ?>
                                        <a id="dstuser-<?php echo $dstUser ?>" role="button" class="btn btn-following ms-2"><?php echo (sizeof($res) != 0 ? "Unfollow" : "Follow") ?></a>
                                    <?php
                                    }
                                    $query = "SELECT NumberFollower from utente WHERE IdUser = $dstUser";
                                    $numFollower = $dbh->execQuery($query)[0]['NumberFollower'];
                                    ?>
                                    <div class="row row-cols-2 my-3 d-flex">
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Follower: <?php echo $numFollower ?>
                                            </a>
                                            <?php
                                            $query = "SELECT u.IdUser, u.Username, u.IdMedia
                                                    FROM follow AS f
                                                    JOIN utente AS u ON f.IdSrc = u.IdUser
                                                    WHERE f.IdDst = '{$dstUser}';";
                                            $followerList = $dbh->execQuery($query);
                                            ?>
                                            <ul class="dropdown-menu" style="width: 300px;">
                                                <?php
                                                foreach ($followerList as $follower) {
                                                ?>
                                                    <?php
                                                    $query = "SELECT FilePath from media WHERE IdMedia = '{$follower['IdMedia']}';";
                                                    $path = $dbh->execQuery($query)[0]['FilePath'];
                                                    ?>
                                                    <li class="d-flex align-items-center mt-3 ms-2">
                                                        <img src="../<?php echo $path ?>" alt="" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                                        <?php echo drawLinkUsernameDropdown($follower['Username'], $follower['IdUser'], "profilePage.php") ?>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>

                                        <div class="dropdown col-2">
                                            <a class="btn btn-secondary dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php
                                                $query = "SELECT COUNT(*) AS NumFollowing FROM follow WHERE IdSrc = '$dstUser';";
                                                $numFollowed = $dbh->execQuery($query)[0]['NumFollowing']
                                                ?>
                                                Followed: <?php echo $numFollowed ?>
                                            </a>
                                            <?php
                                            $query = "SELECT u.IdUser, u.Username, u.IdMedia
                                                FROM follow AS f
                                                JOIN utente AS u ON f.IdDst = u.IdUser
                                                WHERE f.IdSrc = '$dstUser';";
                                            $followedList = $dbh->execQuery($query);
                                            ?>
                                            <ul class="dropdown-menu" style="width: 300px;">
                                                <?php
                                                foreach ($followedList as $followed) {
                                                ?>
                                                    <?php
                                                    $query = "SELECT FilePath from media WHERE IdMedia = '{$followed['IdMedia']}';";
                                                    $path = $dbh->execQuery($query)[0]['FilePath'];
                                                    ?>
                                                    <?php
                                                    ?>
                                                    <li class="d-flex align-items-center mt-3 ms-2">
                                                        <img src="../<?php echo $path ?>" alt="" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                                        <?php echo drawLinkUsernameDropdown($followed['Username'], $followed['IdUser'], "profilePage.php") ?>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                </section>
                                <section class="pb-5">
                                    <ul class="list-group list-unstyled">
                                        <li class="my-2"><strong><?php echo $user["Username"]; ?></strong></li>
                                        <li class="my-2"><strong><?php echo $user["Name"] . " " . $user["Surname"]; ?></strong></li>
                                        <li class="my-2"><?php echo $user["Description"]; ?></li>
                                    </ul>
                                </section>
                                <section>
                                    <?php
                                    foreach ($posts as $userPost) {
                                        $empty = false;
                                        if ($userPost['IdPreview'] != NULL) {
                                            $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$userPost['IdPreview']};";
                                            $previewPath = $dbh->execQuery($queryPreview)[0]["FilePath"];
                                            $previewPath = "../" . $previewPath;
                                            $empty = false;
                                        } else {
                                            $empty = true;
                                        }
                                        $category = getCategory($dbh, $userPost);
                                    ?>
                                        <div class="card border-1 mt-2 p-2" style="width: auto;">
                                            <?php
                                            if (!$empty) {
                                            ?>
                                                <img src="<?php echo $previewPath ?>" class="card-img-top rounded" alt="Preview image">
                                            <?php
                                            }
                                            ?>
                                            <div class="card-body">
                                                <p id="show-date"><?php echo substr($userPost["Date"], 0, 10); ?></p>
                                                <?php
                                                if ($category !== NULL) {
                                                ?>
                                                    <span class="badge border rounded-pill mb-2" id="category-badge">
                                                        <?php echo $category; ?>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                                <h5 class="card-title">
                                                    <?php echo $userPost["Title"]; ?>
                                                </h5>
                                                <p class="card-text">
                                                    <?php echo $userPost["Description"]; ?>
                                                </p>
                                                <a href="../post/viewPost.php?id=<?php echo ($userPost["IdPost"]); ?>">
                                                    <button class="btn btn-primary">More</button>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>