<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['userId'])) {
    echo ($_SESSION['userId']);
} else {
    echo ("");
}
