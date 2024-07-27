<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

/** @var $bets */
$pageContent = includeTemplate('lot.php', [
    'bets'         => $bets,
    'categoryList' => $categoryList,
]);

/** @var $authStatus */
/** @var $user */
$layoutContent = includeTemplate('layout/main.php', [
    'authStatus'  => $authStatus,
    'categoryList' => $categoryList,
    'pageContent' => $pageContent,
    'title'       => 'lot',
    'user'        => $user,
]);

print $layoutContent;
