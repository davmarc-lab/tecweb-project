<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['oldValueLogin'])) {
    $_SESSION['oldValueLogin'] = [
        "username" => "",
    ];
}

echo (htmlspecialchars($_SESSION['oldValueLogin']['username']));

