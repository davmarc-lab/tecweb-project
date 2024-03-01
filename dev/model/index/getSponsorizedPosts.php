<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    require_once "../../includes/database.php";
    
    $query = "SELECT * FROM sponsor WHERE IdPost NOT IN (SELECT IdPost FROM post WHERE IdUser = {$_SESSION['userId']});";
    $res = $dbh->execQuery($query);

    $allPosts = [];

    foreach ($res as $row) {
        $id = $row["IdPost"];
        $postQuery = "SELECT * FROM post WHERE IdPost = {$id};";
        $postRes = $dbh->execQuery($postQuery);
        $post = $postRes[0];
        array_push($allPosts, $post);
    }

    echo json_encode($allPosts);
?>
