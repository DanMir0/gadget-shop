<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'email' => 'Поле :attribute должно быть действительным электронным адресом.',
    'min' => [
        'string' => 'Поле :attribute должно содержать минимум :min символов.',
    ],
    'attributes' => [
        'name' => 'имя',
        'email' => 'email',
        'password' => 'пароль',
        'password_confirmation' => 'подтверждение пароля',
    ],
    'password' => [
        'symbols' => 'Пароль должен содержать хотя бы один специальный символ.',
    ],
];
