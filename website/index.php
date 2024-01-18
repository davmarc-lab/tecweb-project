<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Thasadith:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="includes/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="getPosts.js" type="text/javascript" defer></script>
    <link rel="stylesheet" href="postStyle.css">
    <title>NoteForAll</title>
</head>

<body id="index-id">
    <?php
    session_start();
    if (!isset($_SESSION["userId"])) {
        header("location: login/login.php");
    }
    
    require_once("includes/database.php");
    include_once("includes/navbar.php");
    include_once("includes/utils.php");

    updateLastSeen($dbh, $_SESSION["userId"]);
    unsetSearchKey();

    $bar = new Navbar("");
    $bar->drawNavbar("HomePage");
    $query = "SELECT post.*
        FROM post
        JOIN follow ON post.IdUser = follow.IdDst
        WHERE follow.IdSrc = {$_SESSION['userId']}
        ORDER BY post.Date ASC;";
    $res = $dbh->execQuery($query);
    $_SESSION['homePagePosts'] = $res;
    ?>

    <div class="container-fluid mt-3">
        <div class="row">
            <!-- all post loaded -->
            <div class="col-lg-8 col-md-12 col-12 justify-content-center" id="posts-container">
                <!-- 10 gia messi -->
            </div>

            <!-- suggested profile -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="suggested-profile">
                    <h1>Suggested Profile</h1>
                    <ul class="list-unstyled">
                        <?php
                        $queryProfile = "SELECT u.*
                            FROM utente u
                            WHERE u.IdUser <> {$_SESSION['userId']}
                            AND u.IdUser NOT IN (SELECT f.IdDst FROM follow f WHERE f.IdSrc = {$_SESSION['userId']})
                            ORDER BY RAND()
                            LIMIT 5;";
                        $res = $dbh->execQuery($queryProfile);
                        foreach ($res as $suggested) {
                            $querySuggestedIcon = "SELECT FilePath from media WHERE IdMedia = {$suggested['IdMedia']};";
                            $previewPathSuggestedIcon = $dbh->execQuery($querySuggestedIcon)[0]['FilePath'];
                        ?>
                            <li class="mt-3">
                                <img src="<?php echo "" . $previewPathSuggestedIcon; ?>" alt="" class="rounded rounded-5" width="40" height="40">
                                <a href="profile/profilePage.php?user=<?php echo ($suggested["IdUser"]); ?>" style="font-family: 'Thasadith', sans-serif; font-size: 25px; width: 300px;">@<?php echo $suggested["Username"] ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
