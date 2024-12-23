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
    'contact_info'
];

/** @var $link */
/** @var array $ERROR_MESSAGE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key) {
        if (!isset($_POST[$key])) {
            continue;
        }

        $postInput[$key] = trim($_POST[$key]);
        if (!empty(validateFormData($postInput[$key], $key, $ERROR_MESSAGE, $link))) {
            $errors[$key] = validateFormData($postInput[$key], $key, $ERROR_MESSAGE, $link);
        }
    }

    if (empty($errors)) {
        if (createUser($link, $postInput)) {
            $_SESSION['userCreated'] = 'Вы успешно зарегистрировали аккаунт';
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
