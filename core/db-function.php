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

function getLotsByCategory(mysqli $link, int $categoryId, int $page, bool $f = false, $perPage = ITEMS_PER_PAGE)
{
    $lots = [];

    if ($page >= 1) {
        $offset = ($page - 1) * $perPage;
        if ($f) {
            $sql = "
                SELECT `lot`.*, `category`.`name` AS category_name
                FROM lot
                JOIN category on category.id = lot.category_id
                WHERE lot.category_id = $categoryId
            ";
        } else {
            $sql = "
                SELECT `lot`.*, `category`.`name` AS category_name
                FROM lot
                JOIN category on category.id = lot.category_id
                WHERE lot.category_id = $categoryId
                LIMIT $perPage OFFSET $offset
            ";
        }
        $result = mysqli_query($link, $sql);
        while ($lot = mysqli_fetch_assoc($result)) {
            $lots[] = $lot;
        }
    }

    if ($f) {
        return count($lots);
    } else {
        return $lots;
    }
}

function getBetsByUser(mysqli $link, int $userId): ?array
{
    $bets = [];
    $sql = "
        SELECT `bet`.*, `lot`.`title` AS name_lot, `lot`.`photo_path` AS photo_path, `lot`.`deadline` AS deadline, `category`.`name` AS category_name
        FROM `bet`
        JOIN `lot` ON `bet`.`lot_id` = `lot`.`id`
        JOIN `category` on `category`.`id` = `lot`.`category_id`
        WHERE `bet`.`user_id` = $userId
    ";
    $result = mysqli_query($link, $sql);
    while ($bet = mysqli_fetch_assoc($result)) {
        $bets[] = $bet;
    }

    return $bets;
}

/**
 * @param mysqli $link
 * @param string $query
 * @return array|null
 */
function getLotsBySearchQuery(mysqli $link, string $query, int $page, bool $f = false, $perPage = ITEMS_PER_PAGE)
{
    $lots = [];

    if ($page >= 1) {
        $offset = ($page - 1) * $perPage;
        if ($f) {
            $sql = "
                SELECT `lot`.*, `c`.`name` AS category_name
                FROM `lot`
                JOIN `category` `c` ON `c`.`id` = `lot`.`category_id`
                WHERE `title` LIKE '%$query%'
            ";
        } else {
            $sql = "
                SELECT `lot`.*, `c`.`name` AS category_name
                FROM `lot`
                JOIN `category` `c` ON `c`.`id` = `lot`.`category_id`
                WHERE `title` LIKE '%$query%'
                LIMIT $perPage OFFSET $offset
            ";
        }
        $result = mysqli_query($link, $sql);
        while ($lot = mysqli_fetch_assoc($result)) {
            $lots[] = $lot;
        }
    }
    if ($f) {
        return count($lots);
    } else {
        return $lots;
    }

}

function getUserByEmail(mysqli $link, string $email): ?array
{
    $email = mysqli_real_escape_string($link, $email);
    $sql = "
        SELECT `user`.*, `user_profile`.`name` AS user_name, `user_profile`.`contact_info` AS contact_info, `user_profile`.`avatar_path` AS avatar_path
        FROM `user`
        JOIN `user_profile` ON `user`.`id` = `user_profile`.`user_id`
        WHERE email = '$email'
    ";
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

function getLotsPaginated(mysqli $link, int $page, $perPage = ITEMS_PER_PAGE): ?array
{
    $lots = [];

    if ($page >= 1) {
        $offset = ($page - 1) * $perPage;
        $sql = "
            SELECT `lot`.*, `c`.`name` AS category_name
            FROM `lot`
            JOIN `category` `c` ON `c`.`id` = `lot`.`category_id`
            LIMIT $perPage OFFSET $offset
        ";
        $result = mysqli_query($link, $sql);
        while ($lot = mysqli_fetch_assoc($result)) {
            $lots[] = $lot;
        }
    }

    return $lots;
}

function getLotPageCount(mysqli $link): int
{
    $sql = "
        SELECT COUNT(id) AS count
        FROM lot
    ";

    $result = mysqli_query($link, $sql);

    return intval(mysqli_fetch_assoc($result)['count']);
}