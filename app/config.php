<?php

session_start();

define('DSN', 'mysql:host=localhost; dbname=todos; charset=utf8mb4');
define('USERNAME', 'root');
define('PASSWORD', 'sato1987');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/todo');

require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Token.php');
require_once(__DIR__ . '/Utils.php');
require_once(__DIR__ . '/Todo.php');
