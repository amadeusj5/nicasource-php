<?php

$request = $_SERVER['REQUEST_URI'];

if ($request == '/' || $request == '') {
    require_once dirname(__DIR__) . '/app/views/comic.php';
}
