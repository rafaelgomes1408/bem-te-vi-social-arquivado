<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Importa Str para geração de UUID

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Insere registros de usuários de teste na tabela 'usuarios'.
     */
    public function run(): void
    {
        // Inserindo dois usuários de teste diretamente na tabela 'usuarios'
        DB::table('usuarios')->insert([
            [
                'idUsuario' => (string) Str::uuid(), // Gera um UUID único para o primeiro usuário
                'nomeUsuario' => 'Teste Teste',     // Nome completo do primeiro usuário
                'email' => 'teste@teste.com',       // E-mail do primeiro usuário
                'senha' => Hash::make('teste1234'), // Hash seguro da senha para proteger o acesso
                'idPerfil' => (string) Str::uuid(), // Gera um UUID único para o perfil do primeiro usuário
            ],
            [
                'idUsuario' => (string) Str::uuid(), // Gera um UUID único para o segundo usuário
                'nomeUsuario' => 'José das Neves',  // Nome completo do segundo usuário
                'email' => 'neves@teste.com',       // E-mail do segundo usuário
                'senha' => Hash::make('teste1234'), // Hash seguro da senha para proteger o acesso
                'idPerfil' => (string) Str::uuid(), // Gera um UUID único para o perfil do segundo usuário
            ],
        ]);
    }
}
