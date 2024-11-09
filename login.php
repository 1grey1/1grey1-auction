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
        $sql = "
            SELECT `user`.*, `user_profile`.`name` AS user_name, `user_profile`.`contact_info` AS contact_info, `user_profile`.`avatar_path` AS avatar_path
            FROM `user`
            JOIN `user_profile` ON `user`.`id` = `user_profile`.`user_id`
            WHERE email = '$email'
        ";
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
