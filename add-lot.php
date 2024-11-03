<?php

declare(strict_types=1);

require_once './core/init.php';

if (!isset($_SESSION['user'])) {
   header('Location: login.php');
   exit;
}
/** @var mysqli $link */
/** @var  $categories */
/** @var ?array $user */

$errors = [];
$postInput = [];

$fields = [
    'title',
    'start_price',
    'description',
    'bet_step',
    'deadline',
    'category_id'
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
    if (!$_FILES['photo']['tmp_name']) {
        $errors['photo'] = 'Добавте фото, пожалуйста!';
    }

    if (empty($errors)) {
        $extension = explode('.', $_FILES['photo']['name'])[1];
        $name = uniqid() . '.' . $extension;
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            'uploads/' . $name
        );

        $title = mysqli_real_escape_string($link, $postInput['title']);
        $startPrice = mysqli_real_escape_string($link, $postInput['start_price']);
        $description = mysqli_real_escape_string($link, $postInput['description']);
        $betStep = mysqli_real_escape_string($link, $postInput['bet_step']);
        $deadline = mysqli_real_escape_string($link, $postInput['deadline']);
        $photo = mysqli_real_escape_string($link, $name);
        $categoryId = intval($postInput['category_id']);
        $userId = intval($user['id']);
        $sql = "INSERT INTO lot (
                    title,
                    photo_path,
                    start_price,
                    description,
                    bet_step,
                    deadline,
                    user_id,
                    category_id
                 ) VALUES (
                    '$title',
                    '$photo',
                    '$startPrice',
                    '$description',
                    '$betStep',
                    '$deadline',
                     $userId,
                     $categoryId
                 )";
        if (mysqli_query($link, $sql)) {
            header('Location: login.php');
            exit;
        }
    }
}

$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('add-lot.php', [
    'categoryList' => $categoryList,
    'categories'   => $categories,
    'errors'       => $errors,
    'postInput'    => $postInput
]);

$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'add-lot',
    'user'         => $user,
]);

print $layoutContent;
