<?php

declare(strict_types=1);

require_once './core/init.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

/** @var $link */
$errors = [];
$postInput = [];

$fields = [
    'email',
    'password',
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
        if ($user = getUserByEmail($link, $postInput['email'])) {
            if (password_verify($postInput['password'], $user['password_hash'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit;
            }
        }
        $errors['email'] = $errors['password'] = 'Пароль или email были введены не верно!';
    }
}

$flashMessage = null;

if (isset($_SESSION['userCreated'])) {
    $flashMessage = $_SESSION['userCreated'];
    unset($_SESSION['userCreated']);
}

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('login.php', [
    'categoryList' => $categoryList,
    'errors'       => $errors,
    'flashMessage' => $flashMessage,
    'postInput'    => $postInput
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'authStatus'   => false,
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'login',
    'user'         => $user
]);

print $layoutContent;
