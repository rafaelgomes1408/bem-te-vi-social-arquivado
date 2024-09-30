<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//HasFactory pode gerar usuários falsos automaticamente durante o desenvolvimento ou os testes.
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    //use HasFactory; Gerar usuários para testes
    use HasUuids;

    // Especificando a chave primária como 'idUsuario'
    protected $primaryKey = 'idUsuario';

    // Adicionando os campos que podem ser preenchidos via atribuição em massa
    protected $fillable = ['nomeUsuario', 'email', 'senha', 'idPerfil'];

    // Caso sua senha seja armazenada no campo 'senha'
    //protected $hidden = ['senha'];

    // Se a senha estiver no campo 'senha', adicione esse método:
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
