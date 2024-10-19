<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('error_reporting', strval(E_ALL));

$prefix = './';
if ($_SERVER['PHP_SELF'] === 'category-seeder.php') {
    $prefix = '../';
    goto db_connect;
}

require_once 'constants.php';
require_once 'helpers.php';
require_once 'functions.php';

session_start();
$user = $_SESSION['user'] ?? null;

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

if (!$link) {
    http_response_code(INTERNAL_SERVER_ERROR);
    exit;
}

require_once 'bootstrap.php';
