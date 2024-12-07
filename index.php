<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $link */
$page = $_GET['page'] ?? 1;
$pageCount = ceil(getLotPageCount($link) / ITEMS_PER_PAGE);

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('index.php', [
    'categories' => $categories,
    'lots'       => getLotsPaginated($link, intval($page)),
    'paginationList' => includeTemplate('_partials/pagination.php', [
        'page'      => intval($page),
        'pageCount' => $pageCount,
        'nameList'  => 'index',
    ]),
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
