<?php
session_start();
unset($_SESSION["userId"]);
if (isset($_SESSION["userId"])) {
    echo (true);
} else {
    echo (false);
}
