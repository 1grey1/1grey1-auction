<?php

declare(strict_types=1);

require_once './core/helpers.php';

$pageContent = includeTemplate('404.php');

$layoutContent = includeTemplate('layout/main.php', [
    'pageContent' => $pageContent,
    'title'       => 'index',
]);

print $layoutContent;