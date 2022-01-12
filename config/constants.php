<?php

$app_debug = env('app_debug') == 'true' ? 1 : 0;

define('ROOT', rtrim($_SERVER['DOCUMENT_ROOT'], 'public/'));
define("ASSETS", $_SERVER['SERVER_NAME'] . '/');
define('ROUTES', ROOT . '/routes/');
define('VIEWS', ROOT . '/views/');
ini_set("display_errors", $app_debug);