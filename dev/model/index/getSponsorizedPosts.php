<?php
    require_once "../../includes/database.php";
    
    $query = "SELECT * FROM sponsor;";
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
