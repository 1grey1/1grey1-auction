<?php

declare(strict_types=1);

function createUserProfile(mysqli $link, array $data): bool
{
    $name = mysqli_real_escape_string($link, $data['name']);
    $contactInfo = mysqli_real_escape_string($link, $data['contact_info']);
    $userId = mysqli_insert_id($link);
    $sql = "INSERT INTO user_profile (name, contact_info, user_id) VALUES ('$name', '$contactInfo', '$userId')";

    return mysqli_query($link, $sql);
}

function createUser(mysqli $link, array $data): bool
{
    $email = mysqli_real_escape_string($link, $data['email']);
    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (email, password_hash) VALUES ('$email', '$passwordHash')";

    if (mysqli_query($link, $sql)) {
        return createUserProfile($link, $data);
    }

    return false;
}

function createCategories(mysqli $link, array $categories): void
{
    foreach ($categories as $category) {
        $sql = "INSERT INTO category (name, inner_code) VALUES ('{$category['name']}', '{$category['inner_code']}')";
        mysqli_query($link, $sql);
    }
}

function getCategories(mysqli $link): mysqli_result
{
    $sql = "SELECT * FROM category";
    return mysqli_query($link, $sql);
}

function getLots(mysqli $link): array
{
    $lots = [];

    $sql = "
        SELECT `lot`.*, `c`.`name` AS category_name
        FROM `lot`
        JOIN `category` `c` ON `c`.`id` = `lot`.`category_id`
    ";
    $result = mysqli_query($link, $sql);
    while ($lot = mysqli_fetch_assoc($result)) {
        $lots[] = $lot;
    }

    return $lots;
}

function getLot(mysqli $link, int $id): ?array
{
    $sql = "
        SELECT `lot`.*, `c`.`name` AS category_name
        FROM `lot`
        JOIN `category` `c` ON `c`.`id` = `lot`.`category_id`
        WHERE `lot`.`id` = $id
    ";
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

function getBets(mysqli $link, int $id): ?array
{
    $bets = [];
    $sql = "
        SELECT `bet`.*, `user_profile`.`name` AS user_name
        FROM `bet`
        JOIN `user_profile` ON `user_profile`.`user_id` = `bet`.`user_id`
        WHERE `bet`.`lot_id` = $id
    ";
    $result = mysqli_query($link, $sql);
    while ($bet = mysqli_fetch_assoc($result)) {
        $bets[] = $bet;
    }

    return $bets;
}

function createBet(mysqli $link, int $cost, int $userId, int $lotId): bool
{
    $sql = "
        INSERT INTO bet (amount, user_id, lot_id)
        VALUES ($cost, $userId, $lotId)
    ";

    return mysqli_query($link, $sql);
}
