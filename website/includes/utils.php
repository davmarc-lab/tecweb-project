<?php

$HOME_DIR;

enum NotificationType: string
{
    case LIKE = "Like";
    case COMMENT = "Comment";
    case FOLLOWER = "Follower";
}

function getHomeDirectory() {
    $parts = explode(DIRECTORY_SEPARATOR, getcwd());

    $index = array_search('website', $parts);

    return implode(DIRECTORY_SEPARATOR, array_slice($parts, 0, $index + 1));
}

$HOME_DIR = getHomeDirectory() . "/";
