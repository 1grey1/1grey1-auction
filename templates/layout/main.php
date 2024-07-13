<?php

/** @var string $pageContent */
/** @var string $title */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="./resources/css/normalize.min.css" rel="stylesheet">
    <link href="./resources/css/style.css" rel="stylesheet">
</head>
<body>

    <?= includeTemplate('layout/_main-header.php', [
            'pageContent' => $pageContent,
    ]) ?>

    <?= includeTemplate('layout/_main-footer.php') ?>

</body>
</html>
