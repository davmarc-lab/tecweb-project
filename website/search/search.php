<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    include_once("../includes/navbar.php");
    require_once("../includes/database.php");
    $bar = new Navbar("../");
    $bar->drawNavbar("Search");
    ?>
    <div class="container-fluid">
        <div class="row mt-5">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input-group">
                    <label for="searchText" class="visually-hidden">Search</label>
                    <input type="text" id="searchText" name="searchText" class="form-control" placeholder="Search" aria-describedby="searchIcon" />
                    <button type="submit" class="btn btn-outline-secondary" id="searchButton" name="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (!isset($_POST['submit'])) {
    ?>
        <div class="container-fluid justify-content-center align-items-center text-center">
            <div class="row mt-5 d-flex justify-content-center align-items-center text-center">
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Programmazione 1</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">OOP</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">MDP</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 justify-content-center align-items-center text-center">
                <div class="col-md-4 col-12 mx-auto mt-0 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Ricerca operativa</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Algoritmi e strutture dati</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Algebra lineare</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        unset($_POST['submit']);
        $searchKey = $_POST['searchText'];
        $query = "SELECT * FROM post WHERE Title LIKE '%$searchKey%' ORDER BY NumberVote DESC;";
        $res = $dbh->execQuery($query);
        $index = 0;
    ?>
        <div class="container-fluid justify-content-center align-items-center text-center">
            <?php
            foreach ($res as $post) {
                if ($index == 0) {
                    echo "<div class=\"row mt-5 d-flex justify-content-center align-items-center text-center\">";
                }
            ?>
                <div class="col-md-4 col-12 mx-auto mt-5 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="test.jpg" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['Title']; ?></h5>
                            <p class="card-text"><?php echo $post['Description']; ?></p>
                            <button class="btn btn-primary">More</button>
                        </div>
                    </div>
                </div>
        <?php
                if ($index == 2) {
                    echo "</div>";
                }
                $index = ($index + 1) % 3;
            }
        }

        ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>