<!DOCTYPE html>
<html lang="en">

<?php
require_once("../includes/database.php");
session_start();

$showEdit = true;
$dstUser = $_SESSION["userId"];
if (isset($_GET["user"]) && ($dstUser != $_GET["user"])) {
    $dstUser = $_GET["user"];
    $showEdit = false;
}
$query = "SELECT * FROM member WHERE IdUser = $dstUser";
$username = $dbh->execQuery($query)[0]["Username"];
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../includes/newStyle.css" />
    <script src="profile_script/editProfileResize.js"></script>
    <script src="../includes/followScript.js"></script>
    <link rel="icon" href="../nfa-icon.png" type="image/x-icon" />
    <title>NFA - <?php echo($username); ?></title>
</head>

<body>
    <?php
    include_once("../includes/utils.php");
    if (!isset($_SESSION["userId"])) {
        // login not done
        header("location: ../login/login.php");
    }
    updateLastSeen($dbh, $_SESSION["userId"]);

    $showEdit = true;
    $dstUser = $_SESSION["userId"];
    if (isset($_GET["user"]) && ($dstUser != $_GET["user"])) {
        $dstUser = $_GET["user"];
        $showEdit = false;
    }

    $user = $dbh->execQuery("SELECT * FROM member WHERE member.IdUser=$dstUser")[0];
    $posts = $dbh->execQuery("SELECT * FROM post WHERE post.IdUser=$dstUser ORDER BY post.Date DESC");

    include_once("../includes/navbar.php");
    $navbar = new Navbar("../");
    $navbar->drawNavbar("Profile");
    ?>
    <main>
        <?php
        if ($showEdit) {
        ?>
            <div class="container-fluid">
                <?php
            } else {
                ?>
                    <div class="container-centered">
                        <?php
                    }
                        ?>
                        <section class="px-3">
                            <section class="pt-3">
                                <?php
                                if (!$showEdit) {
                                ?>
                                    <div class="text-left">
                                        <a href="javascript: history.go(-1)" role="button" class="btn btn-utility-contrast mb-3 btn-back" title="Go back">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php
                                }
                                $query = "SELECT FilePath from media WHERE IdMedia = {$user['IdMedia']};";
                                $previewPath = $dbh->execQuery($query)[0]['FilePath'];
                                ?>
                                <div class="row">
                                    <img src="../<?php echo $previewPath ?>" alt="" class="profile-page-icon" />
                                    <?php
                                    if ($showEdit) {
                                        unsetSearchKey();
                                    ?>
                                        <a href="editProfile.php" role="button" class="btn d-lg-none ms-2">Edit</a>
                                    <?php
                                    } else {
                                        // checks if the user follow.
                                        $query = "SELECT * FROM follow WHERE IdSrc = {$_SESSION['userId']}
                                    AND IdDst = $dstUser";
                                        $res = $dbh->execQuery($query);
                                    ?>
                                        <a id="dstuser-<?php echo $dstUser ?>" role="button" class="btn btn-following ms-2"><?php echo (sizeof($res) != 0 ? "Unfollow" : "Follow") ?></a>
                                    <?php
                                    }
                                    $query = "SELECT NumberFollower from member WHERE IdUser = $dstUser";
                                    $numFollower = $dbh->execQuery($query)[0]['NumberFollower'];
                                    ?>
                                </div>
                                <div class="row row-cols-2 my-3 d-flex">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle border" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Follower: <?php echo $numFollower ?>
                                        </a>
                                        <?php
                                        $query = "SELECT u.IdUser, u.Username, u.IdMedia
                                            FROM follow AS f
                                            JOIN member AS u ON f.IdSrc = u.IdUser
                                            WHERE f.IdDst = '{$dstUser}';";
                                        $followerList = $dbh->execQuery($query);
                                        ?>
                                        <ul class="dropdown-menu">
                                            <?php
                                            foreach ($followerList as $follower) {
                                            ?>
                                                <?php
                                                $query = "SELECT FilePath from media WHERE IdMedia = '{$follower['IdMedia']}';";
                                                $path = $dbh->execQuery($query)[0]['FilePath'];
                                                ?>
                                                <li class="d-flex align-items-center mt-3 ms-2">
                                                    <img src="../<?php echo $path ?>" alt="" class="profile-icon">
                                                    <?php echo drawLinkUsernameDropdown($follower['Username'], $follower['IdUser'], "profilePage.php") ?>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="dropdown col-2">
                                        <a class="btn btn-secondary dropdown-toggle border" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?php
                                            $query = "SELECT COUNT(*) AS NumFollowing FROM follow WHERE IdSrc = '$dstUser';";
                                            $numFollowed = $dbh->execQuery($query)[0]['NumFollowing']
                                            ?>
                                            Followed: <?php echo $numFollowed ?>
                                        </a>
                                        <?php
                                        $query = "SELECT u.IdUser, u.Username, u.IdMedia
                                        FROM follow AS f
                                        JOIN member AS u ON f.IdDst = u.IdUser
                                        WHERE f.IdSrc = '$dstUser';";
                                        $followedList = $dbh->execQuery($query);
                                        ?>
                                        <ul class="dropdown-menu">
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
                                                    <img src="../<?php echo $path ?>" alt="" class="profile-icon">
                                                    <?php echo drawLinkUsernameDropdown($followed['Username'], $followed['IdUser'], "profilePage.php") ?>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                            </section>
                            <section>
                                <ul>
                                    <li class="my-2"><strong><?php echo $user["Username"]; ?></strong></li>
                                    <li class="my-2"><strong><?php echo $user["Name"] . " " . $user["Surname"]; ?></strong></li>
                                    <li class="my-2<?php echo (strlen($user["Description"]) == 0 ? " d-none" : ""); ?>"><?php echo $user["Description"]; ?></li>
                                </ul>
                            </section>
                            <hr>
                            <section class="posts-container">
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
                                    <div class="card post-card border-1 mt-2 p-2">
                                        <?php
                                        if (!$empty) {
                                        ?>
                                            <img src="<?php echo $previewPath ?>" class="card-img-top rounded" alt="Preview image">
                                        <?php
                                        }
                                        ?>
                                        <div class="card-body">
                                            <p class="show-date"><?php echo substr($userPost["Date"], 0, 10); ?></p>
                                            <?php
                                            if ($category !== NULL) {
                                            ?>
                                                <span class="badge">
                                                    <?php echo $category; ?>
                                                </span>
                                            <?php
                                            }
                                            ?>
                                            <h5 class="card-title">
                                                <?php echo $userPost["Title"]; ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php echo substr($userPost['Description'], 0, 200); ?>
                                                <?php echo strlen($userPost['Description']) > 200 ? '...' : ''; ?>
                                            </p>
                                            <a href="../post/viewPost.php?id=<?php echo ($userPost["IdPost"]); ?>" class="btn btn-primary" role="button">
                                                View Post
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </section>
                        </section>
                        <?php
                        if ($showEdit) {
                        ?>
                            <div class="position-fixed top-20 end-0 pe-5 col-5 d-none d-lg-block">
                                <section>
                                    <?php include_once("editProfileContent.php"); ?>
                                </section>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>