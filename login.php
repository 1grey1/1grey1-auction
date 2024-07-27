<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('login.php', [
    'categoryList' => $categoryList,
]);

/** @var $authStatus */
/** @var $user */
$layoutContent = includeTemplate('layout/main.php', [
    'authStatus'  => $authStatus,
    'pageContent' => $pageContent,
    'title'       => 'login',
    'user'        => $user,
]);

print $layoutContent;
