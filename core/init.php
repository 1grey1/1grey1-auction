<?php

declare(strict_types=1);

require_once 'helpers.php';
require_once 'functions.php';
require_once 'db-function.php';

ini_set('display_errors', '1');
ini_set('error_reporting', strval(E_ALL));

session_start();

$user = $_SESSION['user'] ?? null;

$db = require_once './config/db.php' ;
$mysql = $db['mysql'];

$lots = require_once './data/lot.php';
$bets = require_once './data/bet.php';
$categories = require_once './data/category.php';

$link = mysqli_connect(
    "{$mysql['host']}:{$mysql['port']}",
    $mysql['username'],
    $mysql['password'],
    $mysql['database']
);

if (!$link) {
    http_response_code(500);
    exit;
}
