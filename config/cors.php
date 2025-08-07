<?php
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'register', 'user'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8000'], // Адрес твоего фронтенда (Vue)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // если ты используешь Sanctum
];

