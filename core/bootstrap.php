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
    ],
    'title' => [
        'is_set' => [
            'condition' => function($title) {return empty($title);},
            'message'   => 'Дайте название своему лоту'
        ],
    ],
    'description' => [
        'is_set' => [
            'condition' => function($description) {return empty($description);},
            'message'   => 'Введите описание лота'
        ],
    ],
    'category_id' => [
        'is_set' => [
            'condition' => function($category_id) {return empty($category_id);},
            'message'   => 'Выберите категорию'
        ],
    ],
    'bet_step' => [
        'is_set' => [
            'condition' => function($bet_step) {return empty($bet_step);},
            'message'   => 'Введите цену, в рублях'
        ],
        'is_set_number' => [
            'condition' =>function($bet_step) {return !ctype_digit($bet_step);},
            'message'   => 'Неверный формат цены'
        ],
    ],
    'start_price' => [
        'is_set' => [
            'condition' => function($start_price) {return empty($start_price);},
            'message'   => 'Введите цену, в рублях'
        ],
        'is_set_number' => [
            'condition' =>function($bet_step) {return !ctype_digit($bet_step);},
            'message'   => 'Неверный формат цены'
        ],
    ],
    'deadline' => [
        'is_set' => [
            'condition' => function($deadline) {return empty($deadline);},
            'message'   => 'Это окно обязательно к заполнению'
        ],
        'form_date' => [
            'condition' => function($deadline) {
                $format = 'Y-m-d';

                $dateTime = DateTime::createFromFormat($format, $deadline);

                if (!$dateTime || $dateTime->format($format) !== $deadline) {
                    return true;
                }
                return false;
            },
            'message'   => 'Введите дату в формате YYYY-MM-DD'
        ],
        'deadline_date' => [
            'condition' => function($deadline) {
                $format = 'Y-m-d';

                $dateTime = DateTime::createFromFormat($format, $deadline);

                // Создаём объект "текущая дата + 1 год"
                $oneYearFromNow = new DateTime();
                $oneYearFromNow->modify('+1 year');

                // Если переданная дата больше чем через год — возвращаем true
                if ($dateTime > $oneYearFromNow) {
                    return true;
                }
                return false;
            },
            'message'   => 'Дата окончания не может быть больше чем через год'
        ],
    ],
    'cost' => [
        'is_set' => [
            'condition' => function(array $cost) {return empty($cost[0]);},
            'message'   => 'Введите цену, в рублях'
        ],
        'is_set_number' => [
            'condition' =>function(array $cost) {return !ctype_digit($cost[0]);},
            'message'   => 'Неверный формат цены'
        ],
        'min_bet_step' => [
            'condition' => function(array $cost) {return ((int)$cost[2] >= ((int)$cost[0] - (int)$cost[1]));},
            'message'   => 'Ваша ставка должна быть больше минеимальной'
        ]
    ]
];

foreach (getCategories($link) as $category) {
    $categories[] = $category;
}
