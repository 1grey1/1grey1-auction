<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $link */
/** @var ?array $user */

$errors = [];
$postInput = [];

$fields = [
    'cost'
];

if (isset($user) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key) {
        if (!isset($_POST[$key])) {
            continue;
        }

        $postInput[$key] = trim($_POST[$key]);
        if ($postInput[$key] === '') {
            $errors[$key] = 'Это поле обязательно для заполнения';
        }
    }

    $lot_id = intval($_GET['id']);
    if (createBet($link, $postInput['cost'], $user['id'], $lot_id)) {
        header("Location: lot.php?id=$lot_id");
        exit;
    }
}

if (!isset($_GET['id']) || (!$lot = getLot($link, intval($_GET['id'])))) {
    header('Location: 404.php');
    exit;
}

$bets = getBets($link, intval($_GET['id']));

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('lot.php', [
    'bets'         => $bets,
    'categoryList' => $categoryList,
    'lot'          => $lot,
    'user'         => $user,
]);

/** @var ?array $user */
$layoutContent = includeTemplate('layout/main.php', [
    'categoryList' => $categoryList,
    'pageContent'  => $pageContent,
    'title'        => 'lot',
    'user'         => $user,
]);

print $layoutContent;
