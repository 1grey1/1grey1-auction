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
