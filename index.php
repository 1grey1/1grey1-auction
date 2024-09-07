<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

/** @var  $lots */
$pageContent = includeTemplate('index.php', [
    'categoryList' => $categoryList,
    'lots'         => $lots,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList'  => $categoryList,
    'mainClassName' => 'container',
    'pageContent'   => $pageContent,
    'title'         => 'index',
    'user'          => $user,
]);

print $layoutContent;
