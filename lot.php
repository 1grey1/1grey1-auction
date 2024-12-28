<?php

declare(strict_types=1);

require_once './core/init.php';

/** @var $link */
/** @var ?array $user */

if (!isset($_GET['id']) || (!$lot = getLot($link, intval($_GET['id'])))) {
    header('Location: 404.php');
    exit;
}

$errors = [];
$postInput = [];

$fields = [
    'cost'
];

/** @var array $ERROR_MESSAGE */
if (isset($user) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key) {
        if (!isset($_POST[$key])) {
            continue;
        }

        $postInput[$key] = trim($_POST[$key]);
        if (!empty(validateFormData([$postInput[$key], $lot['start_price'], $lot['bet_step']], $key, $ERROR_MESSAGE, $link))) {
            $errors[$key] = validateFormData([$postInput[$key], $lot['start_price'], $lot['bet_step']], $key, $ERROR_MESSAGE, $link);
        }
    }

    $lot_id = intval($_GET['id']);
    if (empty($errors)) {
        if (createBet($link, intval($postInput['cost']), intval($user['id']), $lot_id)) {
            header("Location: lot.php?id=$lot_id");
            exit;
        }
    }
}

$bets = getBets($link, intval($_GET['id']));

/** @var $categories */
$categoryList = includeTemplate('_partials/category-list.php', [
    'categories' => $categories,
]);

$pageContent = includeTemplate('lot.php', [
    'bets'         => $bets,
    'categoryList' => $categoryList,
    'errors'       => $errors,
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
