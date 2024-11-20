<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuarios',  // Atualizado para 'usuarios'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios',  // Atualizado para 'usuarios'
        ],
    ],

    'providers' => [
        'usuarios' => [  // Atualizado para 'usuarios'
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class,  // Usando o modelo Usuario
        ],
    ],

    'passwords' => [
        'usuarios' => [  // Atualizado para 'usuarios'
            'provider' => 'usuarios',
            'table' => 'password_reset_tokens',  // Tabela de tokens de redefinição
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
