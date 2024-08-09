<?php

declare(strict_types=1);

require_once './core/init.php';

$errors = [];

$fields = [
    'email',
    'password',
    'name',
    'contact_info',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key) {
        if (isset($_POST[$key]) && trim($_POST[$key]) === '') {
            $errors[$key] = 'error massage';
        }
    }
}

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('sign-up.php', [
    'categoryList' => $categoryList,
    'errors'       => $errors,
]);

/** @var $authStatus */
/** @var $user */
$layoutContent = includeTemplate('layout/main.php', [
    'authStatus'   => $authStatus,
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'sign-up',
    'user'         => $user,
]);

print $layoutContent;
