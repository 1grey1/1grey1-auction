<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var mysqli $link */
/** @var array  $categories */

$categoryId = null;

$page = $_GET['page'] ?? 1;

if ($searchQuery = $_GET['search'] ?? null) {
    $lots = getLotsBySearchQuery($link, $searchQuery, intval($page));
    $pageCount = ceil(getLotsBySearchQuery($link, $searchQuery, intval($page), true) / ITEMS_PER_PAGE);
    $param = 'search=' . $searchQuery;
} elseif ($categoryId = $_GET['category_id'] ?? null) {
    $lots = getLotsByCategory($link, intval($categoryId), intval($page) );
    $pageCount = ceil(getLotsByCategory($link, intval($categoryId), intval($page), true) / ITEMS_PER_PAGE);
    $param = 'category_id=' . $categoryId;
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
    'paginationList' => includeTemplate('_partials/pagination.php', [
        'page'      => intval($page),
        'pageCount' => $pageCount,
        'nameList'  => 'all-lots',
        'param'     => $param,
    ]),
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
