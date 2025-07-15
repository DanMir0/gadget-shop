<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'email' => 'Поле :attribute должно быть действительным электронным адресом.',
    'min' => [
        'string' => 'Поле :attribute должно содержать минимум :min символов.',
    ],
    'max' => [
      'string' =>  'Поле :attribute должно содержать макимум :max символов.',
    ],
    'attributes' => [
        'name' => 'имя',
        'email' => 'email',
        'password' => 'пароль',
        'password_confirmation' => 'подтверждение пароля',
        'address.full_name' => 'ФИО',
        'address.phone' => 'телефон',
        'address.city' => 'город',
        'address.street' => 'улица',
        'address.house' => 'дом',
        'address.apartment' => 'квартира',
        'address.comments' => 'комментарий',
    ],
    'password' => [
        'symbols' => 'Пароль должен содержать хотя бы один специальный символ.',
    ],
];
