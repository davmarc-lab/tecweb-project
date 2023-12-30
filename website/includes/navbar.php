<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<?php
function drawNavbar($pageName)
{
?>
    <nav class="navbar sticky-top navbar-expand-md bg-success bg-gradient text-white">
        <div class="container-fluid">
            <a class="navbar-brand text-white fs-2 p-2" href="#"><?php echo ($pageName); ?></a>
            <button class="navbar-toggler p-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo ($pageName); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <i class="bi bi-house"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <i class="bi bi-search"></i>
                                Search
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <i class="bi bi-bell"></i>
                                Notification
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <i class="bi bi-plus-circle"></i>
                                New Post
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="profile/profilePage.php">
                                <i class="bi bi-person-fill"></i>
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php
}
?>