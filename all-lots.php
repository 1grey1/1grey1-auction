<?php

declare(strict_types=1);

require_once './core/init.php';



/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$paginationList = includeTemplate('_partials/pagination.php');

/** @var $link */

if ($nameLike = $_GET['search']) {
    $lots = getLotsByLike($link, $nameLike);
    $category = 'ALL';
} else {
    $lots = getLotsByCategory($link, intval($_GET['category_id']));
    $category = categoryName($categories, intval($_GET['category_id']));
}

$pageContent = includeTemplate('all-lots.php', [
    'lots'           => $lots,
    'categoryList'   => $categoryList,
    'category'       => $category,
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
