<?php

declare(strict_types=1);

require_once '../core/init.php';

$categories = require_once "../data/category.php";

/** @var mysqli $link */
createCategories($link, $categories);
