<?php

declare(strict_types=1);

function esc(string $string): string
{
    return htmlspecialchars($string);
}

function escCost(string $number): string
{
    return number_format(intval(esc($number)) , thousands_separator: ' ');
}

function getCategoryName(array $categories, ?int $categoryId): string
{
    $name = '';
    foreach ($categories as $category) {
        if (intval($category['id']) === $categoryId) {
            $name = $category['name'];
        }
    }
    return $name;
}

function dump(array $array): void
{
    print('<pre>');
    print_r($array);
    print('</pre>');
    exit;
}

function validateFormData($value, string $key, array $errorMessages, mysqli $link = null)
{
    $error = null;
    foreach ($errorMessages[$key] as $errorMessage){
        if ($errorMessage['condition']($value, $link)){
            $error = $errorMessage['message'];
            http_response_code(400);
            break;
        }
    }
    return $error;
}
