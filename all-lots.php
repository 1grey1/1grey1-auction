<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var mysqli $link */
/** @var array  $categories */

$categoryId = null;

if ($searchQuery = $_GET['search'] ?? null) {
    $lots = getLotsBySearchQuery($link, $searchQuery);
} elseif ($categoryId = $_GET['category_id'] ?? null) {
    $lots = getLotsByCategory($link, intval($categoryId));
} else {
    header( 'Location: index.php');
    exit;
}


$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('all-lots.php', [
    'lots'           => $lots,
    'categoryList'   => $categoryList,
    'category'       => getCategoryName($categories, intval($categoryId)),
    'paginationList' => includeTemplate('_partials/pagination.php'),
    'searchQuery'    => $searchQuery
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'searchQuery'  => $searchQuery ?? null,
    'title'        => 'all-lots',
    'user'         => $user,
]);

print $layoutContent;
