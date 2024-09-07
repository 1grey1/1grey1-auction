<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

/** @var $lots */
$pageContent = includeTemplate('search.php', [
    'categoryList' => $categoryList,
    'lots'         => $lots,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'search',
    'user'         => $user,
]);

print $layoutContent;
