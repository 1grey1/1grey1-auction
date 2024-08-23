<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $link */

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
        if ($link) {
            $email = mysqli_real_escape_string($link, $postInput['email']);
            $passwordHash = password_hash($postInput['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (email, password_hash) VALUES ('$email', '$passwordHash')";

            if (mysqli_query($link, $sql)) {
                header('Location: login.php');
                exit;
            }
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
