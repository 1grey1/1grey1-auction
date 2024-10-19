<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$paginationList = includeTemplate('_partials/pagination.php');

/** @var $link */
$pageContent = includeTemplate('all-lots.php', [
    'lots'           => getLotsByCategory($link, intval($_GET['category_id'])),
    'categoryList'   => $categoryList,
    'category'       => categoryName($categories, intval($_GET['category_id'])),
    'paginationList' => $paginationList
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'all-lots',
    'user'         => $user,
]);

print $layoutContent;
