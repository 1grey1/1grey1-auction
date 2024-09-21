<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('error_reporting', strval(E_ALL));

$prefix = './';
if ($_SERVER['PHP_SELF'] === 'category-seeder.php') {
    $prefix = '../';
    goto db_connect;
}

require_once 'helpers.php';
require_once 'functions.php';

session_start();
$user = $_SESSION['user'] ?? null;
$categories = [];

db_connect:
require_once 'db-function.php';
$db = require_once "{$prefix}config/db.php" ;
$mysql = $db['mysql'];

$link = mysqli_connect(
    "{$mysql['host']}:{$mysql['port']}",
    $mysql['username'],
    $mysql['password'],
    $mysql['database']
);

foreach (getCategories($link) as $category) {
    $categories[] = $category;
}

if (!$link) {
    http_response_code(500);
    exit;
}

$categoriesShell = require_once "{$prefix}/data/category.php";
