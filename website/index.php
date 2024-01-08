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
    $bar = new Navbar("./");
    $bar->drawNavbar("HomePage");
    $currId = $_SESSION["userId"];
    $query = "SELECT post.*
        FROM post
        JOIN follow ON post.IdUser = follow.IdDst
        WHERE follow.IdSrc = '$currId'
        ORDER BY post.Date DESC;";
    $res = $dbh->execQuery($query);
    $_SESSION['homePagePosts'] = $res;
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-8 col-12 justify-content-center" id="postContainer">
                <?php
                $counter = 0;
                foreach ($res as $post) {
                ?>
                    <div class="card border-0 mx-auto mt-2" style="max-width: 35rem;">
                        <?php
                            $authorId = $post["IdUser"];
                            $queryAuthor = "SELECT Username from utente WHERE IdUser = '$authorId';";
                            $authorUser = $dbh->execQuery($queryAuthor);
                        ?>
                        <p>@<?php echo $authorUser[0]["Username"] ?></p>
                        <img src="search/test.jpg" class="card-img-top img-fluid" alt="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-lg <?php echo (getClass($dbh, $post['IdPost']) ? "d-none" : ""); ?>" style="border: none; background: white;" <?php echo "onClick=\"likePost({$post['IdPost']})\" id=\"bttLike{$post['IdPost']}\"" ?>><i class="bi bi-hand-thumbs-up"></i></button>
                                    <button type="button" class="btn btn-lg <?php echo (getClass($dbh, $post['IdPost']) ? "" : "d-none"); ?>" style="border: none; background: white;" <?php echo "onClick=\"dislikePost({$post['IdPost']})\" id=\"bttLikeFill{$post['IdPost']}\"" ?>><i class="bi bi-hand-thumbs-up-fill"></i></button>
                                    <button type="button" class="btn btn-lg" style="border: none; background: white;"><i class="bi bi-chat-left-text"></i></button>
                                    <h5 class="card-title"><?php echo $post["Title"] ?></h5>
                                    <p class="card-text"><?php echo $post["Description"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                array_shift($_SESSION['homePagePosts']);
                $counter++;
                if ($counter == 10) {
                    break;
                }
                }
                //print_r($_SESSION['homePagePosts']);
                ?>
            </div>

            <div class="col-md-3 d-none d-sm-block">
                <div class="container position-fixed" style="background: #F5F5F5; height: auto; margin-top: 25vh; padding: 20px; border-radius: 10px;">
                    <div class="container justify-content-center align-items-center">
                        <h1 style="font-family: 'Thasadith', sans-serif; font-size: 40px; color: #FD7A01;">Suggested profile</h1>
                        <ul class="list-unstyled">
                            <li class="mt-3"><a href="#" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none;">@Profilo_numero1</a></li>
                            <li class="mt-3"><a href="#" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none;">@Profilo_numero2</a></li>
                            <li class="mt-3"><a href="#" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none;">@Profilo_numero3</a></li>
                            <li class="mt-3"><a href="#" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none;">@Profilo_numero4</a></li>
                            <li class="mt-3"><a href="#" style="font-family: 'Thasadith', sans-serif; font-size: 25px; color: black; text-decoration: none;">@Profilo_numero5</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-1 d-none d-sm-block">
                <div class="container position-fixed" style="background: #FFF; height: 100vh; margin-top: 25vh; padding: 20px;">
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php 
    function getClass($dbh, $idPost) {
        session_start();
        $query = "SELECT * FROM vote WHERE IdPost = '$idPost' AND IdUser = '{$_SESSION['userId']}';";
        $res = $dbh->execQuery($query);
        return count($res) > 0;
    }
?>