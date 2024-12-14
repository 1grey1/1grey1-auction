<?php

/** @var string  $categoryList */
/** @var ?string $mainClassName */
/** @var string  $pageContent */
/** @var ?string $searchQuery */
/** @var string  $title */
/** @var ?array  $user */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>auction | <?= $title ?></title>
    <link href="../resources/css/normalize.min.css" rel="stylesheet">
    <link href="../resources/css/style.css" rel="stylesheet">
    <link href="../resources/css/fix.css" rel="stylesheet">
    <link href="../resources/css/app.css" rel="stylesheet">
</head>
<body>
    <div class="page-wrapper">
        <?= includeTemplate('layout/_main-header.php', [
            'searchQuery' => $searchQuery ?? null,
            'user'        => $user,
        ]) ?>

        <main class="<?= $mainClassName ?? '' ?>">
            <?= $pageContent ?>
        </main>
    </div>

    <?= includeTemplate('layout/_main-footer.php', [
            'categoryList' => $categoryList,
    ]) ?>

    <script src="https://kit.fontawesome.com/ede81f2f60.js" crossorigin="anonymous"></script>

    <script src="../../src/timer.js"></script>
</body>
</html>
