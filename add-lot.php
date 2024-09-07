<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var  $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('add-lot.php', [
    'categoryList' => $categoryList,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'add-lot',
    'user'         => $user,
]);

print $layoutContent;
