<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'idPostagem',
        'idUsuario',
        'categoria',
        'descricao', // Incluído para permitir atribuição de descrição
    ];

    public $incrementing = true; // A chave primária é do tipo integer (auto-increment)
    protected $keyType = 'int'; // Tipo da chave primária
}
