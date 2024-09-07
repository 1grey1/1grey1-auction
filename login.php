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
        $email = mysqli_real_escape_string($link, $postInput['email']);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($link, $sql);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($postInput['password'], $user['password_hash'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit;
            }
        }

        $errors['email'] = $errors['password'] = 'Пароль или email были введены не верно!';
    }
}



/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('login.php', [
    'categoryList' => $categoryList,
    'errors'       => $errors,
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
