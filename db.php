<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'webtech_lab5');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

$mysql->set_charset("utf8");
?>