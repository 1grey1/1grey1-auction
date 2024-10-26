<?php

/** @var string  $categoryList */
/** @var ?string $mainClassName */
/** @var string  $pageContent */
/** @var ?array  $user */
/** @var string  $title */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>auction | <?= $title ?></title>
    <link href="../resources/css/normalize.min.css" rel="stylesheet">
    <link href="../resources/css/style.css" rel="stylesheet">
    <link href="../resources/css/fix.css" rel="stylesheet">
</head>
<body>

    <div class="page-wrapper">
        <?= includeTemplate('layout/_main-header.php', [
            'user' => $user,
        ]) ?>

        <main class="<?= $mainClassName ?? '' ?>">
            <?= $pageContent ?>
        </main>
    </div>

    <?= includeTemplate('layout/_main-footer.php', [
        'categoryList' => $categoryList,
    ]) ?>

</body>
</html>
