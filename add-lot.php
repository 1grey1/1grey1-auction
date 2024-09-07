<?php

declare(strict_types=1);

require_once './core/init.php';

if (!isset($_SESSION['user'])) {
   header('Location: login.php');
   exit;
}

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
