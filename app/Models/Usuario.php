<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

    // Nome da tabela no banco de dados
    protected $table = 'usuarios';

    // Definição da chave primária como 'idUsuario'
    protected $primaryKey = 'idUsuario';

    // Os campos que podem ser preenchidos em massa
    protected $fillable = ['nomeUsuario', 'email', 'senha', 'idPerfil', 'imagemPerfil', 'is_admin'];

    // Campos ocultos nas respostas JSON
    protected $hidden = ['senha', 'remember_token'];

    // Indica que a chave primária não é autoincrementada
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Retorna a senha para autenticação do Laravel
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Define o nome do identificador de autenticação
     */
    public function getAuthIdentifierName()
    {
        return 'idUsuario';
    }

    /**
     * Mapeia 'user_id' para 'idUsuario' para compatibilidade com o Laravel
     */
    public function getAttribute($key)
    {
        if ($key === 'user_id') {
            return $this->getAttribute('idUsuario');
        }
        return parent::getAttribute($key);
    }

    /**
     * Mutator para criptografar a senha ao defini-la
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['senha'] = bcrypt($value);
    }

    /**
     * Relacionamento: Um usuário pode ter várias postagens
     */
    public function postagens(): HasMany
    {
        return $this->hasMany(Postagem::class, 'idUsuario', 'idUsuario');
    }

    /**
     * Retorna a URL da imagem de perfil ou a imagem padrão
     */
    public function getImagemPerfilUrl(): string
    {
        if ($this->imagemPerfil && file_exists(storage_path('app/public/' . $this->imagemPerfil))) {
            return asset('storage/' . $this->imagemPerfil);
        }

        // Caminho para a imagem padrão
        return asset('images/default-profile.png');
    }

    /**
     * Exclui o perfil do usuário e todos os dados relacionados
     */
    public function deleteAccount()
    {
        // Exclui as postagens do usuário
        $this->postagens()->delete();

        // Exclui a imagem de perfil se existir
        if ($this->imagemPerfil && file_exists(storage_path('app/public/' . $this->imagemPerfil))) {
            \Storage::disk('public')->delete($this->imagemPerfil);
        }

        // Exclui o próprio usuário
        $this->delete();
    }

    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
