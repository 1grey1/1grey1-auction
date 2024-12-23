<?php

declare(strict_types=1);

$categories = [];

/** @var $link */
$ERROR_MESSAGE = [
    'email' => [
        'is_set' => [
            'condition' => function($email) {return empty($email);},
            'message'   => 'Это окно обязательно к заполнению'
        ],
        'form' => [
            'condition' => function($email) {return !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email);},
            'message'   => 'Укажите корректный email.'
        ],
        'used' => [
            'condition' => function($email, $link=null) {return findEmailInDB($link, $email);},
            'message'   => 'Email уже существует'
        ]
    ],
    'password' => [
        'is_set' => [
            'condition' => function($password) {return empty($password);},
            'message'   => 'Это окно обязательно к заполнению'
        ],
        'lenMin' => [
            'condition' => function($password) {return mb_strlen($password) < 6;},
            'message'   => 'Пароль должен быть не мение 6 символов'
        ]
    ],
    'name' => [
        'is_set' => [
            'condition' => function($name) {return empty($name);},
            'message'   => 'Это окно обязательно к заполнению'
        ],
        'len' => [
            'condition' => function($name) {return mb_strlen($name) < 2 || mb_strlen($name) > 20;},
            'message'=>'Имя должно быть от 2 до 20 сибволов'
        ]
    ],
    'contact_info' => [
        'is_set' => [
            'condition' => function($text) {return empty($text);},
            'message'   => 'Это окно обязательно к заполнению'
        ]
    ]
];

foreach (getCategories($link) as $category) {
    $categories[] = $category;
}
