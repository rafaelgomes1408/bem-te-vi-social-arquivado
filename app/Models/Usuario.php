<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory, HasUuids;

    // Nome da tabela
    protected $table = 'usuarios';

    // Especificando a chave primária como 'idUsuario'
    protected $primaryKey = 'idUsuario';

    // Adicionando os campos que podem ser preenchidos via atribuição em massa
    protected $fillable = ['nomeUsuario', 'email', 'senha', 'idPerfil'];

    // Ocultando a senha e o token de autenticação nas respostas JSON
    protected $hidden = ['senha', 'remember_token'];

    // Configura o campo 'senha' como o campo de senha esperado pelo Laravel
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
