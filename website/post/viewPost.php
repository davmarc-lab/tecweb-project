<!DOCTYPE html>
<html lang="en">

<?php
require_once("../includes/database.php");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>NFA - <?php echo ($infoPost["Title"]); ?></title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="row m-auto mb-4">
        <?php
        include_once("../includes/navbar.php");
        $bar = new Navbar("../");
        $bar->drawNavbar("Post");
        ?>
    </div>

    <div class="container-fluid col-8 mx-auto py-auto py-3 d-block bg-success">
        <!-- post section -->
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
                ?>
                    <img class="img-fluid d-flex" style="width: 200px; height: 200px;" src="<?php echo ($previewPath); ?>" alt="File Preview Image">
                <?php
                }

                // get media information
                $mediaId = $infoPost["IdMedia"];
                $query = "SELECT * FROM media WHERE IdMedia = $mediaId;";
                $mediaRes = $dbh->execQuery($query)[0];
                $mediaPath = $mediaRes["FilePath"];
                $mediaName = $mediaRes["FileName"];

                ?>
                <!-- write the media and download link -->
                <span class="col-6 justify-content-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    <a class="link-dark link-offset-2" href="<?php echo ($mediaPath) ?>" download><?php echo ($mediaName); ?></a>
                </span>
            </div>
            <!-- Likes, comment bar -->
            <div class="row">
                <form action="../addComment.php" method="POST">
                    <div class="form-group">
                        <label for="textAreaComment" hidden>Insert your comment here</label>
                        <textarea class="form-control" id="textAreaComment" rows="3" placeholder="Add your comment" name="commentText"></textarea>
                        <label for="submitComment" hidden>Publish your comment</label>
                        <input type="submit" value="Comment" id="submitComment" class="btn btn-primary mt-3 float-end">
                        <input type="hidden" name="idPost" value="<?php echo $infoPost['IdPost']; ?>">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>