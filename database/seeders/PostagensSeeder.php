<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Postagem;
use Illuminate\Support\Str; // Importa Str para geração de UUID

class PostagensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter os usuários criados
        $usuarios = Usuario::all();

         // Iterar sobre cada usuário
         foreach ($usuarios as $usuario) {
            // Criar 15 postagens para cada usuário
            for ($i = 0; $i < 15; $i++) {
                Postagem::create([
                    'idPostagem' => (string) Str::uuid(), // Gerando UUID para a postagem
                    'conteudo' => fake()->text(250), // Conteúdo aleatório de até 250 caracteres
                    'dataHora' => now(), // Data e hora atuais
                    'isOfensiva' => false, // Definido como não ofensiva por padrão
                    'idUsuario' => $usuario->idUsuario, // Associando a postagem ao usuário
                ]);
            }
        }
    }
}
