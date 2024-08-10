<?php

declare(strict_types=1);

require_once 'helpers.php';
require_once 'functions.php';
require_once 'db-function.php';

$lots = require_once './data/lot.php';
$bets = require_once './data/bet.php';
$categories = require_once './data/category.php';

$authStatus = false;
$user = [
    'name' => 'Константин'
];
