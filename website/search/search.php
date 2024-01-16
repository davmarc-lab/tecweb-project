<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../includes/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../profile/profile_script/followScript.js"></script>
    <script src="searchScript.js" defer></script>
    <script src="categoryFilter.js" type="text/javascript"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include_once("../includes/navbar.php");
    require_once("../includes/database.php");
    include_once("../includes/utils.php");
    updateLastSeen($dbh, $_SESSION["userId"]);
    $bar = new Navbar("../");
    $bar->drawNavbar("Search");
    ?>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="input-group">
                <label for="search-text" class="visually-hidden">Search</label>
                <input type="text" id="search-text" name="search-text" class="form-control" placeholder="Search" aria-describedby="searchIcon" />
                <button type="" class="btn btn-outline-secondary" id="searchButton" name="submit" onclick="searchResult()">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <div class="row mt-4">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose categories
                    </button>
                    <div class="dropdown-menu p-1" aria-labelledby="categoryDropdown">
                        <div class="container d-flex">
                            <input type="text" name="categorySearch" id="categorySearch" class="form-control" placeholder="Search category" />
                            <a class="btn btn-utility btn-secondary ms-1" role="button" id="reset">Clear</a>
                        </div>
                        <div class="container mt-2 scrollable-menu">
                            <?php
                            $categories = getAllCategories($dbh);
                            foreach ($categories as $cat) {
                            ?>
                                <a class="dropdown-item btn-primary rounded my-1" role="button" value="<?php echo ($cat["IdCategory"]); ?>"><?php echo ($cat["Description"]); ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div id="selected-categories"></div>
                </div>
            <div id="category-badges"></div>
        </div>
    </div>
    <?php
    if (!isset($_SESSION["search_result"]["post"])) {
    ?>
        <div class="container-fluid justify-content-center align-items-center text-center">
            <?php
            $query = "SELECT * FROM post ORDER BY RAND() LIMIT 9;";
            $res = $dbh->execQuery($query);
            printPost($res, $dbh);
            ?>
        </div>
    <?php
    } else {
    ?>
        <div class="container-fluid">
                <div class="row mt-4 justify-content-center">
                    <div class="container col-md-8">
                        <?php
                        if (!empty($_SESSION["search_result"]["profile"])) {
                            printProfile($dbh, $_SESSION["search_result"]["profile"]);
                        }
                        ?>
                    </div>
                </div>
            <div class="row justify-content-center align-items-center text-center">
                <?php
                printPost($_SESSION["search_result"]["post"], $dbh);
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
function printPost($res, $dbh)
{
    $index = 0;
    foreach ($res as $post) {
        if ($post['IdPreview'] != NULL) {
            $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$post['IdPreview']};";
            $previewPath = $dbh->execQuery($queryPreview)[0]['FilePath'];
            $previewPath = "../" . $previewPath;
            $empty = "false";
        } else {
            $empty = "true";
        }
        
        if ($index == 0) {
            echo "<div class=\"row mt-5 d-flex justify-content-center align-items-center text-center\">";
        }
?>
        <div class="col-md-4 col-12 mx-auto my-5 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <?php
                if ($empty !== "true") {
                ?>
                    <img src="<?php echo $previewPath ?>" class="card-img-top" alt="Image">
                <?php
                }
                ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['Title']; ?></h5>
                    <p class="card-text"><?php echo $post['Description']; ?></p>
                    <a href="../post/viewPost.php?id=<?php echo ($post["IdPost"]); ?>">
                        <button class="btn btn-primary">More</button>
                    </a>
                </div>
            </div>
        </div>
<?php
        if ($index == 2) {
            echo "</div>";
        }
        $index = ($index + 1) % 3;
    }
    if ($index != 0) {
        echo "</div>";
    }
}
?>

<?php
function printProfile($dbh, $res)
{
?>
    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Username</th>
                    <th class="text-center d-none d-md-table-cell" scope="col">Posts</th>
                    <th class="text-center d-none d-md-table-cell" scope="col">Follower</th>
                    <th class="text-center" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $user) {
                ?>
                    <tr>
                        <td class="text-center" scope="row"><?php echo drawLinkUsername($user['Username'], $user['IdUser'], "../profile/profilePage.php"); ?></th>
                        <td class="text-center d-none d-md-table-cell"><?php echo $user['NumberPost'] ?></td>
                        <td class="text-center d-none d-md-table-cell"><?php echo $user['NumberFollower'] ?></td>
                        <td class="text-center">
                            <?php
                            $query = "SELECT * FROM follow WHERE IdSrc = {$_SESSION['userId']}
                                        AND IdDst = {$user['IdUser']}";
                            $test = $dbh->execQuery($query);
                            $pathFollow = "'../profile/followUserQuery.php'";
                            $pathUnfollow = "'../profile/unfollowUserQuery.php'";
                            ?>
                            <a id="followButton" onclick="followUser(<?php echo $_SESSION['userId'] . ', ' . $user['IdUser'] . ', ' . $pathFollow; ?>)" role="button" class="btn btn-following <?php echo (sizeof($test) != 0 ? "d-none" : "") ?>">Follow</a>
                            <a id="unfollowButton" onclick="unfollowUser(<?php echo ($_SESSION['userId'] . ', ' . $user['IdUser'] . ', ' . $pathUnfollow); ?>)" role="button" class="btn btn-following <?php echo (sizeof($test) == 0 ? "d-none" : "") ?>">Unfollow</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
?>