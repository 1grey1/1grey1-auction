<?php

declare(strict_types=1);

require_once './core/helpers.php';

$categoryList = includeTemplate('_partials/category-list.php');

$pageContent = includeTemplate('index.php', [
    'categoryList' => $categoryList,
]);

$layoutContent = includeTemplate('layout/main.php', [
    'mainClassName' => 'container',
    'pageContent' => $pageContent,
    'title'       => 'index',
]);

print $layoutContent;
