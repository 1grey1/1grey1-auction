<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $link */
if (!isset($_GET['id']) || (!$lot = getLot($link, intval($_GET['id'])))) {
    header('Location: 404.php');
    exit;
}

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

/** @var $bets */
$pageContent = includeTemplate('lot.php', [
    'bets'         => [],
    'categoryList' => $categoryList,
    'lot'          => $lot,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'lot',
    'user'         => $user,
]);

print $layoutContent;
