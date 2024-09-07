<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

unset($_SESSION['user']);

header('Location: index.php');
exit;
