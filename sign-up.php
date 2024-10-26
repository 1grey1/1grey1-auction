<?php

declare(strict_types=1);

require_once './core/init.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$errors = [];
$postInput = [];

$fields = [
    'email',
    'password',
    'name',
    'contact_info',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key) {
        if (!isset($_POST[$key])) {
            continue;
        }

        $postInput[$key] = trim($_POST[$key]);
        if ($postInput[$key] === '') {
            $errors[$key] = 'Это поле обязательно для заполнения';
        }
    }

    if (empty($errors)) {
        /** @var $link */
        if (createUser($link, $postInput)) {
            header('Location: login.php');
            exit;
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
    'postInput'    => $postInput
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'sign-up',
    'user'         => $user
]);

print $layoutContent;
