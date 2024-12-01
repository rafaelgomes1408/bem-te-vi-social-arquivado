<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Usuario::updateOrCreate(
            ['email' => 'adminrafael@email.com'], // Critério para encontrar o registro
            [
                'idUsuario' => (string) \Illuminate\Support\Str::uuid(),
                'nomeUsuario' => 'Admin',
                'senha' => bcrypt('123456789'),
                'is_admin' => true,
            ]
        );
    }
}
