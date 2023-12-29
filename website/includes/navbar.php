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
                                <img src="../icons/homeIcon.png" class="bi" />
                                Home
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <img src="../icons/searchIcon.png" class="bi" />
                                Search
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <img src="../icons/alarmIcon.png" class="bi" />
                                Notification
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <img src="../icons/addIcon.png" class="bi" />
                                New Post
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="icon-link icon-link-hover link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                <img src="../icons/userIcon.png" class="bi" />
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