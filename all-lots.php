<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var  $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$paginationList = includeTemplate('_partials/pagination.php');

/** @var $lots */
$pageContent = includeTemplate('all-lots.php', [
    'lots'           => $lots,
    'categoryList'   => $categoryList,
    'paginationList' => $paginationList
]);

/** @var $authStatus */
/** @var $user */
$layoutContent = includeTemplate('layout/main.php', [
    'authStatus'  => $authStatus,
    'categoryList' => $categoryList,
    'pageContent' => $pageContent,
    'title'       => 'all-lots',
    'user'        => $user,
]);

print $layoutContent;
