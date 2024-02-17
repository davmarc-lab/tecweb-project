<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Thasadith:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="includes/newStyle.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="includes/cookieScript.js"></script>
    <script src="getPosts.js" defer></script>
    <link rel="icon" href="nfa-icon.png" type="image/x-icon" />
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

    <div class="index-container">
        <!-- all post loaded -->
        <div class="posts-container" id="posts-container">
        </div>

        <!-- suggested profile -->
        <div class="suggested-profile">
            <h1>Suggested Profile</h1>
            <ul>
                <?php
                $queryProfile = "SELECT u.*
                    FROM member u
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
                        <img src="<?php echo "" . $previewPathSuggestedIcon; ?>" alt="" class="profile-icon">
                        <a href="profile/profilePage.php?user=<?php echo ($suggested["IdUser"]); ?>">@<?php echo $suggested["Username"] ?></a>
                    </li>
                <?php
                }
                
                ?>
            </ul>
        </div>
        <?php
        if (!isset($_COOKIE["user" . $_SESSION["userId"]])) {
        ?>
            <div class="row">
                <div id="cookie-notify" class="fixed-bottom col-12">
                    <p><strong>This site uses technical cookies to improve the user experience</strong></p>
                    <button id="ok-button">Ok</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>