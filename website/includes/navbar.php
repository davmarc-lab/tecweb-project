<?php
class Navbar
{
    private $homePath;
    private $logout = "includes/logOut.php";
    private $homePage = "index.php";
    private $searchPage = "search/search.php";
    private $notifPage = "notification/notification.php";
    private $newPostPage = "post/newPost.php";
    private $profilePage = "profile/profilePage.php";
    private $scriptThemePath = "includes/themeScript.js";
    private $style = "includes/style.css";

    public function __construct($homePath)
    {
        $this->homePath = $homePath;
    }

    public function drawNavbar($pageName)
    {
?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <?php include_once("utils.php"); ?>
        <link rel="stylesheet" href="<?php echo (getHomeDirectoryValue()  . ($this->style)); ?>">
        <script src="<?php echo (($this->homePath) . ($this->scriptThemePath)); ?>"></script>
        <nav class="navbar sticky-top navbar-expand-md">
            <div class="container-fluid">
                <p class="navbar-brand fs-2 p-2 m-0"><?php echo ($pageName); ?></p>
                <button class="navbar-toggler p-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="navbarOffcanvasLg">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo ($pageName); ?></h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-1">
                            <li class="nav-item p-2">
                                <a class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" href="<?php echo (($this->homePath) . ($this->homePage)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" href="<?php echo (($this->homePath) . ($this->searchPage)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                    Search
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" href="<?php echo (($this->homePath) . ($this->notifPage)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                                    </svg>
                                    Notification
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" href="<?php echo (($this->homePath) . ($this->newPostPage)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    New Post
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" href="<?php echo (($this->homePath) . ($this->profilePage)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <form action="<?php echo $this->homePath . $this->logout; ?>">
                                    <button class="icon-link icon-link-hover link-underline-opacity-0 link-underline-opacity-75-hover" type="submit" style="background: none; border: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                        </svg>
                                        Log out
                                    </button>
                                </form>
                            </li>
                            <li class="nav-item p-2">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" role="switch" id="switch-theme" onclick="changeTheme()">
                                    <label for="switch-theme" hidden>Checkbox to choose light or dark theme</label>
                                    <span id="theme-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
                                            <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                                        </svg>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
<?php
    }
};

?>