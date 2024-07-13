<?php

declare(strict_types=1);

require_once './core/helpers.php';

$pageContent = includeTemplate('all-lots.php');

$layoutContent = includeTemplate('layout/main.php', [
    'pageContent' => $pageContent,
    'title'       => 'index',
]);

print $layoutContent;
