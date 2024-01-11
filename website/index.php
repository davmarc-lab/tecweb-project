<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Thasadith:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="likePostScript.js"></script>
    <title>NoteForAll</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["userId"])) {
        header("location:login/login.php");
    }
    require_once("includes/database.php");
    include_once("includes/navbar.php");
    include_once("includes/utils.php");
    $bar = new Navbar("./");
    $bar->drawNavbar("HomePage");
    $query = "SELECT post.*
        FROM post
        JOIN follow ON post.IdUser = follow.IdDst
        WHERE follow.IdSrc = {$_SESSION['userId']}
        ORDER BY post.Date DESC;";
    $res = $dbh->execQuery($query);
    $_SESSION['homePagePosts'] = $res;
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 justify-content-center" id="postContainer">
                <?php
                $counter = 0;
                foreach ($res as $post) {
                ?>
                    <div class="card border-0 mx-auto mt-4" style="max-width: 35rem;">
                        <?php
                        $queryAuthor = "SELECT * from utente WHERE IdUser = {$post['IdUser']};";
                        $authorUser = $dbh->execQuery($queryAuthor)[0];
                        $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$post['IdPreview']};";
                        $previewPath = $dbh->execQuery($queryPreview)[0]['FilePath'];
                        //$previewPath = substr($previewPath, 2);
                        ?>
                        <p><?php echo (drawLinkUsername($authorUser["Username"], $authorUser["IdUser"], "profile/profilePage.php")); ?></p>
                        <img src="<?php echo $previewPath ?>" class="card-img-top img-fluid" alt="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-lg <?php echo (getClass($dbh, $post['IdPost']) ? "d-none" : ""); ?>" style="border: none; background: white;" onclick="likePost('<?php echo $post['IdPost'] ?>','<?php echo $post['IdUser'] ?>')" id="bttLike<?php echo $post['IdPost'] ?>"><i class="bi bi-hand-thumbs-up"></i></button>
                                    <button type="button" class="btn btn-lg <?php echo (getClass($dbh, $post['IdPost']) ? "" : "d-none"); ?>" style="border: none; background: white;" onclick="dislikePost('<?php echo $post['IdPost'] ?>','<?php echo $post['IdUser'] ?>')" id="bttLikeFill<?php echo $post['IdPost'] ?>"><i class="bi bi-hand-thumbs-up-fill text-primary"></i></button>
                                    <span class="badge bg-secondary ms-4"><?php echo $post['NumberComment'] ?></span>
                                    <button type="button" class="btn btn-lg" style="border: none; background: white;"><i class="bi bi-chat-left-text"></i></button>
                                    <h5 class="card-title"><?php echo $post["Title"] ?></h5>
                                    <p class="card-text"><?php echo $post["Description"] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $queryComments = "SELECT * FROM usercomment WHERE IdPost = {$post['IdPost']}
                                ORDER BY IdComment DESC LIMIT 3;";
                        $comments = $dbh->execQuery($queryComments);
                        foreach ($comments as $comment) {
                            $queryUserComment = "SELECT Username from utente WHERE IdUser = {$comment['IdUser']};";
                            $userComment = $dbh->execQuery($queryUserComment);
                        ?>
                            <p class="border border-success rounded p-1">@<?php echo $userComment[0]['Username'] ?>: <?php echo $comment['CommentText'] ?></p>
                        <?php
                        }
                        ?>
                        <form action="addComment.php" method="POST">
                            <div class="form-group">
                                <label for="textAreaComment" hidden>Insert your comment here</label>
                                <textarea class="form-control" id="textAreaComment" rows="3" placeholder="Add your comment" name="commentText"></textarea>
                                <label for="submitComment" hidden>Publish your comment</label>
                                <input type="submit" value="Comment" id="submitComment" class="btn btn-primary mt-3 float-end">
                                <input type="hidden" name="idPost" value="<?php echo $post['IdPost']; ?>">
                            </div>
                        </form>
                    </div>
                <?php
                    array_shift($_SESSION['homePagePosts']);
                    $counter++;
                    if ($counter == 10) {
                        break;
                    }
                }
                ?>
            </div>

            <div class="col-lg-3 d-none d-lg-block">
                <div style="background: #F5F5F5; position: fixed; top: 30vh; padding: 20px; border-radius: 10px; width: 300px;">
                    <h1 style="font-family: 'Thasadith', sans-serif; font-size: 30px; color: #FD7A01; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 300px;">Suggested Profile</h1>
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
                        ?>
                            <li class="mt-3">
                                <img src="immagine_profilo.jpg" alt="" width="40" height="40">
                                <a href="profile/profilePage.php?user=<?php echo ($suggested["IdUser"]); ?>" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none; width: 300px;">@<?php echo $suggested["Username"] ?></a>
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

<?php
function getClass($dbh, $idPost)
{
    session_start();
    $query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = '{$_SESSION['userId']}';";
    $res = $dbh->execQuery($query);
    return count($res) > 0;
}
?>