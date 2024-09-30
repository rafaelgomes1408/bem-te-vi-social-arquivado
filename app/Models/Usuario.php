<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//HasFactory pode gerar usuários falsos automaticamente durante o desenvolvimento ou os testes.
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Model
{
    use HasFactory; //Gerar usuários para testes
    use HasUuids;

    // Especificando a chave primária como 'idUsuario'
    protected $primaryKey = 'idUsuario';

    // Adicionando os campos que podem ser preenchidos via atribuição em massa
    protected $fillable = ['nomeUsuario', 'email', 'senha', 'idPerfil'];
}
