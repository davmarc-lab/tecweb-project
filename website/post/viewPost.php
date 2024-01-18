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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../includes/style.css" />
    <script src="commentScript.js"></script>
    <title>NFA - <?php echo ($infoPost["Title"]); ?></title>
</head>

<body>
    <div class="row m-auto mb-4">
        <?php
        include_once("../includes/navbar.php");
        $bar = new Navbar("../");
        $bar->drawNavbar("Post");
        ?>
    </div>

    <div class="container-fluid col-12 col-md-8 mx-auto py-auto py-3 d-block">
        <div id="view-post" class="border rounded p-3">
            <!-- post section -->
            <a href="javascript: history.go(-1)" role="button" class="btn btn-utility mb-3" title="Go back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
            <section>
                <!-- write the post title -->
                <div class="row justify-content-start">
                    <h1 class="m-auto">
                        <?php echo ($infoPost["Title"]); ?>
                    </h1>
                </div>
                <!-- write in the center of the container the post description -->
                <div class="row justify-content-center">
                    <div class="col-11">
                        <p>
                            <?php echo ($infoPost["Description"]); ?>
                        </p>
                        <p class="show-date"><?php echo substr($infoPost["Date"], 0, 10); ?></p>
                    </div>
                </div>
                <div class="row col-11 mx-auto d-flex align-items-center">
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
                        <img class="img-fluid col-8 mx-auto" src="<?php echo ($previewPath); ?>" alt="File Preview Image">
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
                    <!-- write the media and download link -->
                    <span class="col-6 mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>
                        <a class="link-offset-2" href="<?php echo ($mediaPath) ?>" download><?php echo ($mediaName); ?></a>
                    </span>
                </div>
                <hr>
                <!-- Comment bar -->
                <div class="row mt-3" id="comments-row">
                    <div class="form-group" id="comment-input">
                        <label for="comment-text" hidden>Insert your comment here</label>
                        <textarea class="form-control" id="comment-text" rows="3" placeholder="Add your comment" name="commentText"></textarea>
                        <label for="comment-button" hidden>Publish your comment</label>
                        <button id="comment-button" class="btn btn-primary mt-3 float-end">Comment</button>
                    </div>
                    <div clas="mt-1 mb-0" id="comments-area">
                        <?php
                        $queryComments = "SELECT * FROM usercomment WHERE IdPost = {$infoPost['IdPost']}
                                ORDER BY IdComment ASC;";
                        $comments = $dbh->execQuery($queryComments);
                        $comments = array_reverse($comments);
                        foreach ($comments as $comment) {
                            $queryUserComment = "SELECT * from utente WHERE IdUser = {$comment['IdUser']};";
                            $userComment = $dbh->execQuery($queryUserComment)[0];
                        ?>
                            <div class="me-2 mt-3">
                                <div class="border border-success rounded p-auto">
                                    <p class="p-2 text-break m-0"><?php echo (drawLinkUsername($userComment["Username"], $userComment["IdUser"], "../profile/profilePage.php")); ?>: <?php echo $comment['CommentText'] ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>