<?php

$request = $_SERVER['REQUEST_URI'];

if ($request == '/' || $request == '') {
    define('COMIC_ID', null);
    require_once dirname(__DIR__) . '/app/views/comic.php';
    return;
}

if (preg_match('/^\/comic\/(?P<id>\d+)$/i', $request, $matches)) {
    foreach ($matches as $key => $match) {
        if (is_string($key)) {
            define('COMIC_ID', (int) $match);
            break;
        }
    }

    require_once dirname(__DIR__) . '/app/views/comic.php';
}
