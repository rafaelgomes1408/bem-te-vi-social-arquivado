<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postagem extends Model
{
    use HasUuids;

    protected $table = 'postagens'; // Nome da tabela no banco de dados

    // Especifica que a chave primária é 'idPostagem'
    protected $primaryKey = 'idPostagem';

    protected $fillable = ['conteudo', 'dataHora', 'idUsuario']; // Campos permitidos para atribuição em massa

    public $incrementing = false; // UUID não é autoincrementado
    protected $keyType = 'string'; // UUID é uma string

    // Define o campo 'dataHora' como uma instância de Carbon para trabalhar com datas no Laravel
    protected $casts = [
        'dataHora' => 'datetime',
    ];

    /**
     * Relacionamento com o modelo Usuario.
     * Cada postagem pertence a um usuário.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario'); // Relacionamento com a chave estrangeira 'idUsuario'
    }
}
