<?php
require_once("includes/database.php");
require_once("includes/utils.php");
session_start();
$counter = 0;
$ret = '';

foreach ($_SESSION['homePagePosts'] as $post) {
    $ret .= '<div class="card border border-5 border-primary-subtle rounded mx-auto mt-4 p-3" style="max-width: 35rem;" id="div' . $post['IdPost'] . '>';

    $authorId = $post["IdUser"];
    $queryAuthor = "SELECT * from utente WHERE IdUser = '$authorId';";
    $authorUser = $dbh->execQuery($queryAuthor)[0];
    $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$post['IdPreview']};";
    $previewPath = $dbh->execQuery($queryPreview)[0]['FilePath'];

    $ret .= '<p>' . drawLinkUsername($authorUser["Username"], $authorId, "profile/profilePage.php") . '</p>';
    $ret .= '<img src="' . $previewPath . '" class="card-img-top img-fluid" alt="">';
    $ret .= '<div class="card-body">';
    $ret .= '<div class="row">';
    $ret .= '<div class="col">';
    $ret .= '<button type="button" class="btn btn-lg ' . (getClass($dbh, $post['IdPost']) ? "d-none" : "") . '" style="border: none;" onClick="likePost(' . $post['IdPost'] . ')" id="bttLike' . $post['IdPost'] . '"><i class="bi bi-hand-thumbs-up"></i></button>';
    $ret .= '<button type="button" class="btn btn-lg ' . (getClass($dbh, $post['IdPost']) ? "" : "d-none") . '" style="border: none;" onClick="dislikePost(' . $post['IdPost'] . ')" id="bttLikeFill' . $post['IdPost'] . '"><i class="bi bi-hand-thumbs-up-fill"></i></button>';
    $ret .= '<span class="badge bg-secondary ms-4">' . $post['NumberComment'] . '</span>';
    $ret .= '<button type="button" class="btn btn-lg" style="border: none;"><i class="bi bi-chat-left-text"></i></button>';
    $ret .= '<a href="post/viewPost.php?id=' . $post["IdPost"] . '" class="float-end">';
    $ret .= '<button class="btn btn-primary">More</button>';
    $ret .= '</a>';                              
    $ret .= '<h5 class="card-title">' . $post["Title"] . '</h5>';
    $ret .= '<p class="card-text">' . $post["Description"] . '</p>';
    $ret .= '</div>';
    $ret .= '</div>';
    $ret .= '</div>';
    $queryComments = "SELECT * FROM usercomment WHERE IdPost = {$post['IdPost']}
            ORDER BY IdComment DESC LIMIT 3;";
    $comments = $dbh->execQuery($queryComments);
    foreach ($comments as $comment) {
        $queryUserComment = "SELECT Username from utente WHERE IdUser = {$comment['IdUser']};";
        $userComment = $dbh->execQuery($queryUserComment);
        $ret .= '<p class="border border-success rounded p-1">@' . $userComment[0]['Username'] . ':' . $comment['CommentText'] . '</p>';
    }
    $ret .= '<form action="addComment.php" method="POST">';
    $ret .= '<label for="textAreaComment" hidden>Insert your comment here</label>
            <textarea class="form-control" id="textAreaComment" rows="3" placeholder="Add your comment" name="commentText"></textarea>
            <label for="submitComment" hidden>Publish your comment</label>
            <input type="submit" value="Comment" id="submitComment" class="btn btn-primary mt-3 float-end">';
    $ret .= '<input type="hidden" name="idPost" value="' . $post['IdPost'] . '">';
    $ret .= '<input type="hidden" name="locationTo" value="index.php#' . $post['IdPost'] . '">';
    $ret .= '</div>';
    $ret .= '</form>';
    $ret .= '</div>';

    array_shift($_SESSION['homePagePosts']);
    $counter++;
    if ($counter == 2) {
        break;
    }
}
echo $ret;
?>

<?php
function getClass($dbh, $idPost)
{
    //session_start();
    $query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = '{$_SESSION['userId']}';";
    $res = $dbh->execQuery($query);
    return count($res) > 0;
}
?>