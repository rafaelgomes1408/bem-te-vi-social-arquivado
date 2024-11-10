<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

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

    public function getAuthIdentifierName()
    {
        // Alias para Laravel reconhecer 'idUsuario' como 'user_id'
        return 'idUsuario';
    }

    // Alias para que o Laravel trate 'idUsuario' como 'user_id'
    public function getAttribute($key)
    {
        if ($key === 'user_id') {
            return $this->getAttribute('idUsuario');
        }
        return parent::getAttribute($key);
    }

    // Mutator para garantir que 'password' mapeia para 'senha' ao definir a senha
    public function setPasswordAttribute($value)
    {
        $this->attributes['senha'] = bcrypt($value);
    }
}
