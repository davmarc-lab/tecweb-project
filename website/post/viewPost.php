<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION["userId"])) {
    header("location:../login/login.php");
}
require_once("../includes/database.php");
include_once("../includes/utils.php");
updateLastSeen($dbh, $_SESSION["userId"]);
if (!isset($_GET["id"])) {
    header("location: ../index.php");
}
$viewPostId = $_GET["id"];

$query = "SELECT * FROM post WHERE IdPost = $viewPostId;";
$infoPost = $dbh->execQuery($query)[0];
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../includes/newStyle.css" />
    <script src="commentScript.js"></script>
    <script src="likeScript.js"></script>
    <link rel="icon" href="../nfa-icon.png" type="image/x-icon" />
    <title>NFA - <?php echo ($infoPost["Title"]); ?></title>
</head>

<body>
    <?php
    include_once("../includes/navbar.php");
    $bar = new Navbar("../");
    $bar->drawNavbar("Post");
    ?>

    <div class="container-centered">
        <div id="view-post">
            <!-- post section -->
            <div class="row">
                <a href="javascript: history.go(-1)" role="button" class="btn btn-utility-contrast btn-back" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                </a>
                <?php
                $query = "SELECT Username from member WHERE IdUser = '{$infoPost["IdUser"]}';";
                $username = $dbh->execQuery($query)[0]["Username"];
                ?>
                <p>
                    <?php echo drawLinkUsername($username, $infoPost["IdUser"], "../profile/profilePage.php") ?>
                </p>
            </div>
            <section>
                <!-- write the post title -->
                <div class="row">
                    <h1>
                        <?php echo ($infoPost["Title"]); ?>
                    </h1>
                </div>
                <!-- write in the center of the container the post description -->
                <p>
                    <?php echo ($infoPost["Description"]); ?>
                </p>
                <p class="show-date"><?php echo substr($infoPost["Date"], 0, 10); ?></p>
                <div id="post-files" class="container-centered">
                    <?php
                    // draw the preview.
                    if ($infoPost["IdPreview"] != NULL) {
                        $previewId = $infoPost["IdPreview"];

                        $query = "SELECT * FROM media WHERE IdMedia = $previewId;";
                        $previewRes = $dbh->execQuery($query)[0];
                        $previewPath = $previewRes["FilePath"];
                        $previewName = $previewRes["FileName"];
                        $previewPath = "../" . $previewPath;
                    ?>
                        <img class="img-fluid" src="<?php echo ($previewPath); ?>" alt="File Preview Image">
                    <?php
                    }

                    // get media information
                    $mediaId = $infoPost["IdMedia"];
                    $query = "SELECT * FROM media WHERE IdMedia = $mediaId;";
                    $mediaRes = $dbh->execQuery($query)[0];
                    $mediaPath = $mediaRes["FilePath"];
                    $mediaName = $mediaRes["FileName"];
                    $mediaPath = "../" . $mediaPath;

                    ?>
                </div>
                <!-- write the media and download link -->
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    <a href="<?php echo ($mediaPath) ?>" download><?php echo ($mediaName); ?></a>
                </span>

                <!-- Comment bar -->
                <div id="comments-area">
                    <?php
                    $queryComments = "SELECT * FROM usercomment WHERE IdPost = {$infoPost['IdPost']}
                            ORDER BY IdComment ASC;";
                    $comments = $dbh->execQuery($queryComments);
                    $comments = array_reverse($comments);
                    foreach ($comments as $comment) {
                        $queryUserComment = "SELECT * from member WHERE IdUser = {$comment['IdUser']};";
                        $userComment = $dbh->execQuery($queryUserComment)[0];
                    ?>
                    <p class="comment"><?php echo (drawLinkUsername($userComment["Username"], $userComment["IdUser"], "../profile/profilePage.php")); ?>: <?php echo $comment['CommentText'] ?></p>  
                    <?php
                    }
                    ?>

                </div>
                <label for="comment-text" hidden>Insert your comment here</label>
                <textarea class="form-control" id="comment-text" rows="3" placeholder="Add your comment" name="commentText"></textarea>
                <label for="comment-button" hidden>Publish your comment</label>
                <?php
                $query = "SELECT IdVote from vote WHERE IdUser = {$_SESSION["userId"]} AND IdPost = {$infoPost['IdPost']};";
                $res = $dbh->execQuery($query);
                ?>
                <div id="comments-row">
                    <div class="col">
                        <p class="number-badge" id="vote-indicator"><?php echo $infoPost['NumberVote'] ?></p>
                        <button type="button" class="btn btn-feedback" id="btnlike-<?php echo $infoPost['IdPost'] ?>"><i class="bi <?php echo (count($res) > 0 ? "bi-hand-thumbs-up-fill" : "bi-hand-thumbs-up") ?>"></i></button>
                    </div>
                    <div class="col">
                        <button id="comment-button" class="btn btn-primary btn-comment">Comment</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>