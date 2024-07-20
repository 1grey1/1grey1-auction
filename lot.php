<?php

declare(strict_types=1);

require_once './core/helpers.php';

$categoryList = includeTemplate('_partials/category-list.php');

$pageContent = includeTemplate('lot.php', [
    'categoryList' => $categoryList,
]);

$layoutContent = includeTemplate('layout/main.php', [
    'pageContent' => $pageContent,
    'title'       => 'lot',
]);

print $layoutContent;
