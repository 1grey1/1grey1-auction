<?php

declare(strict_types=1);

require_once './core/init.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

/** @var $link */
$pageContent = includeTemplate('my-bets.php', [
    'bets' => getBetsByUser($link, intval($_SESSION['user']['id'])),
    'categoryList'  => $categoryList,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'my-bets',
    'user'         => $user,
]);

print $layoutContent;
