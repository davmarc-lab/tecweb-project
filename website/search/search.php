<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../includes/newStyle.css" />
    <link rel="stylesheet" href="../includes/scrollableMenu.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="searchScript.js" defer></script>
    <script src="categoryFilter.js"></script>
    <script src="../includes/followScript.js"></script>
    <link rel="icon" href="../nfa-icon.png" type="image/x-icon" />
    <title>NFA - Search</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["userId"])) {
        header("location:../login/login.php");
    }
    include_once("../includes/navbar.php");
    require_once("../includes/database.php");
    include_once("../includes/utils.php");
    updateLastSeen($dbh, $_SESSION["userId"]);
    $bar = new Navbar("../");
    $bar->drawNavbar("Search");
    ?>
    <div class="cascading-container">
        <div class="input-group">
            <label for="search-text" class="visually-hidden" hidden>Search</label>
            <input type="text" id="search-text" name="search-text" class="form-control" placeholder="Search" aria-describedby="search-button" />
            <button class="btn btn-search" id="search-button" name="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>
        </div>
        <div class="row mt-4">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="category-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Choose categories
                </button>
                <div class="dropdown-menu p-1" aria-labelledby="category-dropdown">
                    <div class="container d-flex">
                        <label for="category-search" hidden>Choose zero or one or many categories</label>
                        <input type="text" name="categorySearch" id="category-search" class="form-control" placeholder="Search category" />
                        <a class="btn btn-utility-contrast" role="button" id="reset">Clear</a>
                    </div>
                        <?php
                        $categories = getAllCategories($dbh);
                        foreach ($categories as $cat) {
                        ?>
                            <a class="dropdown-item btn-primary rounded my-1" role="button" id="cat-<?php echo ($cat["IdCategory"]); ?>"><?php echo ($cat["Description"]); ?></a>
                        <?php
                        }
                        ?>
                </div>
                <div id="selected-categories"></div>
            </div>
            <div id="category-badges"></div>
        </div>
        <?php
        if (!isset($_SESSION["search_result"]["post"])) {
        ?>
            <?php
            $query = "SELECT * FROM post ORDER BY RAND() LIMIT 9;";
            $res = $dbh->execQuery($query);
            printPost($res, $dbh);
            ?>
        <?php
        } else {
        ?>
            <div id="profiles-table" class="row">
                <?php
                if (!empty($_SESSION["search_result"]["profile"])) {
                    printProfile($dbh, $_SESSION["search_result"]["profile"]);
                }
                ?>
            </div>
            <div class="card-row">
                <?php
                printPost($_SESSION["search_result"]["post"], $dbh);
                ?>
            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
function printPost($res, $dbh)
{
    $index = 0;
    foreach ($res as $post) {
        $empty = false;
        if ($post['IdPreview'] != NULL) {
            $queryPreview = "SELECT FilePath from media WHERE IdMedia = {$post['IdPreview']};";
            $previewPath = $dbh->execQuery($queryPreview)[0]['FilePath'];
            $previewPath = "../" . $previewPath;
            $empty = false;
        } else {
            $empty = true;
        }

        if ($index == 0) {
            echo "<div class=\"card-row\">";
        }
        $query = "SELECT Username from member WHERE IdUser = '{$post["IdUser"]}';";
        $username = $dbh->execQuery($query)[0]["Username"];
?>
        <div class="card">
            <p class="m-1"><?php echo drawLinkUsername($username, $post["IdUser"], "../profile/profilePage.php") ?></p>
            <?php
            if (!$empty) {
            ?>
                <img src="<?php echo $previewPath ?>" class="card-img-top" alt="Post preview">
            <?php
            }
            $category = getCategory($dbh, $post);
            ?>
            <div class="card-body">
                <p class="show-date"><?php echo substr($post["Date"], 0, 10); ?></p>
                <?php
                if ($category !== NULL) {
                ?>
                    <span class="badge border rounded-pill mb-2">
                        <?php echo $category ?>
                    </span>
                <?php
                }
                ?>
                <h5 class="card-title"><?php echo $post['Title']; ?></h5>
                <p class="card-text"><?php echo substr($post['Description'], 0, 100); ?>
                    <?php echo strlen($post['Description']) > 100 ? '...' : ''; ?>
                </p>
                <a href="../post/viewPost.php?id=<?php echo ($post["IdPost"]); ?>" role="button" class="btn btn-primary view-post">
                    View post
                </a>
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
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" scope="col" id="username">Username</th>
                    <th class="text-center d-none d-md-table-cell" scope="col" id="number-post">Posts</th>
                    <th class="text-center d-none d-md-table-cell" scope="col" id="number-follower">Follower</th>
                    <th class="text-center" scope="col" id="btt-follow"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $user) {
                ?>
                    <tr>
                        <td class="text-center" headers="username"><?php echo drawLinkUsername($user['Username'], $user['IdUser'], "../profile/profilePage.php"); ?></td>
                        <td class="text-center d-none d-md-table-cell" headers="number-post"><?php echo $user['NumberPost'] ?></td>
                        <td class="text-center d-none d-md-table-cell" headers="number-follower"><?php echo $user['NumberFollower'] ?></td>
                        <td class="text-center" headers="btt-follow">
                            <?php
                            if ($user["IdUser"] !== $_SESSION["userId"]) {
                                $query = "SELECT * FROM follow WHERE IdSrc = {$_SESSION['userId']}
                                        AND IdDst = {$user['IdUser']}";
                                $test = $dbh->execQuery($query);
                            ?>
                                <a id="dstuser-<?php echo $user['IdUser'] ?>" role="button" class="btn btn-following"><?php echo (sizeof($test) != 0 ? "Unfollow" : "Follow") ?></a>
                            <?php
                            }
                            ?>
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